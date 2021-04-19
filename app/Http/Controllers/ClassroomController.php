<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseContent;
use App\Models\StudentCourse;
use App\Models\TeacherCourse;
use App\Models\Course;
use App\Models\User;
use Auth;
use Exception;
use App\Exceptions\WebException;

class ClassroomController extends Controller
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
     * 教室首頁
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $userId = Auth::user()->id;

        // 判斷身份(老師、學生、管理者)
        $checkRole = User::where('id', '=', $userId)->select('role')->get()->toArray();
        $role = $checkRole[0]['role'];

        // 判斷是否有權限
        if ($role == 'teacher') {
            $checkTeacherAuthorize = TeacherCourse::where('course_id', '=', $id)
                ->where('teacher_id', '=', $userId)->get()->toArray();
            if (!$checkTeacherAuthorize) {
                throw new WebException('您不是此堂課的老師', 403);
            }
        } elseif ($role == 'user') {
            $checkUserAuthorize = StudentCourse::where('course_id', '=', $id)
                ->where('student_id', '=', $userId)->get()->toArray();
            if (!$checkUserAuthorize) {
                throw new WebException('您沒有購買此課程', 403);
            }
        }

        $courseName = Course::where('id', '=', $id)->get('name')->toArray();
        $courseContent = CourseContent::where('course_id', '=', $id)->get()->toArray();
        $result = [
            'records' => $courseContent,
            'courseName' => $courseName,
        ];

        return view('classroom', $result);
    }

    /**
     * 課程內容
     *
     * @param  int  $courseId
     * @param  int  $content_sequence
     * @return \Illuminate\Http\Response
     */
    public function content($courseId, $content_sequence)
    {
        // 判斷此章節是否存在
        $isTrue = CourseContent::where('course_id', '=', $courseId)
                    ->where('content_sequence', '=', $content_sequence)->get()->toArray();
        if ($isTrue == null) {
            throw new WebException('此章節不存在', 404);
        }

        // 判斷身份(老師、學生、管理者)
        $userId = Auth::user()->id;
        $checkRole = User::where('id', '=', $userId)->select('role')->get()->toArray();
        $role = $checkRole[0]['role'];

        // 判斷是否有權限
        if ($role == 'teacher') {
            $checkTeacherAuthorize = TeacherCourse::where('course_id', '=', $courseId)
                ->where('teacher_id', '=', $userId)->get()->toArray();
            if (!$checkTeacherAuthorize) {
                throw new WebException('您不是此堂課的老師', 403);
            }
        } elseif ($role == 'user') {
            $checkUserAuthorize = StudentCourse::where('course_id', '=', $courseId)
                ->where('student_id', '=', $userId)->get()->toArray();
            if (!$checkUserAuthorize) {
                throw new WebException('您沒有購買此課程', 403);
            }
        }

        $courseName = Course::where('id', '=', $courseId)->get('name')->toArray();
        $courseNav = CourseContent::where('course_id', '=', $courseId)->get()->toArray();
        $courseContent = CourseContent::where('course_id', '=', $courseId)
            ->where('content_sequence', '=', $content_sequence)
            ->get()
            ->toArray();

        $result = [
            'records' => $courseContent,
            'courseNav' => $courseNav,
            'courseName' => $courseName,
        ];
        return view('course_content', $result);
    }
}
