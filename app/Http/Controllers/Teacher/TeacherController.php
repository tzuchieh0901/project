<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\TeacherCourse;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Redirect;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 顯示所有的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Teacher/teacher');
    }

    /**
     * 新增課程頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCourses()
    {
        return view('Teacher/createCourse');
    }

    /**
     * 老師儲存課程資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function teacherStoreCourse(Request $request)
    {
        $image = $request->file('image');
        $path = $request->file('image')->store('images', 'public');
        $image->move(public_path('/images'), $path);

        $courseForm = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'outline' => $request->get('outline'),
            'price' => $request->get('price'),
            'image' => $path,
        ];
        $storeCourseData = Course::create($courseForm)->toArray();
        $storeCourseID = $storeCourseData['id'];

        $userId = Auth::user()->id;
        $teacherForm = [
            'teacher_id' => $userId,
            'course_id' => $storeCourseID,
        ];
        TeacherCourse::create($teacherForm);
        return Redirect::to('/teacher/courses');
    }

    /**
     * 顯示所有教授的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function coursesList()
    {
        $userId = Auth::user()->id;
        $teacherCourses = User::find($userId)->teacherCourses()->get()->toArray();

        // echo '<pre>';
        // print_r($teacherCourses);
        // echo '</pre>';

        $result = ['records' => $teacherCourses];
        return view('Teacher/courseList', $result);
    }

    /**
     * 刪除課程
     * 1. 從course資料表刪除
     * 2. 從teacherCourse資料表把刪除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCourse($id)
    {
        $course = Course::find($id);
        $status = $course->delete();
        TeacherCourse::where('course_id', '=', $id)->delete();
        return Redirect::to('/teacher/courses');
    }

    /**
     * 更新課程資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCourse(Request $request, $id)
    {
        $courseForm = [
            'name' => $request->get('name'),
            'description' => trim($request->get('description')) ?? '',
            'outline' => $request->get('outline') ?? '',
            'price' => $request->get('price'),
        ];

        $course = Course::find($id);
        $status = $course->update($request->toArray());
        return Redirect::to('/teacher/courses');
    }

    /**
     * 顯示更新課程頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateCourse($id)
    {
        $courses = Course::find($id)->toArray();
        $result = ['records' => $courses];
        return view('Teacher/updateCourse', $result);
    }
}
