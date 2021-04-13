<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\CourseContent;
use App\models\Course;

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
