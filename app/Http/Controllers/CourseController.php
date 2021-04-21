<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Auth;
use DB;

class CourseController extends Controller
{
    /**
     * 顯示所有的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('teacher')->paginate(5);
        $result = ['records' => $courses];
        return view('courses', $result);
    }

    /**
     * 首頁
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('welcome');
    }

    /**
     * 顯示單一課程的詳細資料
     *
     * Hints:
     * 1.如果有這堂課的學生，就不要讓他放到購物車
     *
     * @return \Illuminate\Http\Response
     */
    public function courseDetail($id)
    {
        // 判斷是否有此堂課
        $checkThisCourse = Course::find($id);
        if ($checkThisCourse == null) {
            abort(404);
        }

        $course = Course::find($id)->toArray();

        // 判斷是否有登入
        if (Auth::check()) {
            //判斷學生是否擁有這堂課
            $userId = Auth::user()->id;
            $haveCourse = DB::table('student_course')
                                ->where('course_id', '=', $id)
                                ->where('student_id', '=', $userId)
                                ->get()
                                ->toArray();
            if ($haveCourse) {
                $haveCourse = true;
            } else {
                $haveCourse = false;
            }
            $result = [
                'records' => $course,
                'haveCourse' => $haveCourse,
            ];
        } else {
            $result = [
                'records' => $course,
            ];
        }
        return view('course', $result);
    }

    /**
     * 儲存課程資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'outline' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);
        $status = Course::create($validatedData);
        return Redirect::to('/admin/courses');
    }
}
