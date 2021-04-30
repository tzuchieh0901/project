<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\TeacherCourse;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\UploadedFile;
use Storage;
use App\Http\Requests\StoreCourse;
use App\Http\Requests\StoreCourseContent;

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
        return view('teacher/teacher');
    }

    /**
     * 新增課程頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCourses()
    {
        return view('teacher/createCourse');
    }

    /**
     * 老師儲存課程資訊
     *
     * @param  \Illuminate\Http\Request\StoreCourse  $request
     * @return \Illuminate\Http\Response
     */
    public function teacherStoreCourse(StoreCourse $request)
    {
        // 存照片到S3
        $image = md5(uniqid());
        $path = $request->image->path();
        $extension = $request->image->extension();
        $imageName = 'tzuchieh.hsieh/' . $image . '.' . $extension;
        Storage::disk('s3')->put($imageName, file_get_contents($path), 'public');

        // 課程資訊
        $courseData = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'outline' => $request->get('outline'),
            'price' => $request->get('price'),
            'image' => $image . '.' . $extension,
        ];
        $storeCourseData = Course::create($courseData)->toArray();

        // 老師教的課程
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

        $result = ['records' => $teacherCourses];
        return view('teacher/courseList', $result);
    }

    /**
     * 刪除課程
     * 1. 從course資料表刪除
     * 2. 從teacherCourse資料表刪除
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
     * @param  \Illuminate\Http\Request\StoreCourse  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCourse(StoreCourse $request, $id)
    {
        $course = Course::find($id);
        $status = $course->update($request->all());
        return Redirect::to('/teacher/courses');
    }

    /**
     * 顯示更新課程頁面(課程資訊)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateCourse($courseId)
    {
        $courses = Course::find($courseId)->toArray();
        $result = [
            'records' => $courses,
        ];
        return view('teacher/updateCourse', $result);
    }

    /**
     * 顯示更新課程頁面(課程內容)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateCourseContent($courseId)
    {
        $courses = Course::find($courseId)->toArray();
        $courseContent = CourseContent::where('course_id', '=', $courseId)->get()->toArray();
        $result = [
            'courseContent' => $courseContent,
            'courseId' => $courseId,
        ];
        return view('teacher/courseContent', $result);
    }

    /**
     * 刪除課程內容
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCourseContent($courseId, $contentId)
    {
        $courseContent = CourseContent::find($contentId);
        $courseContent->delete();
        return Redirect::to("/teacher/showUpdateCourseContent/$courseId");
    }

    /**
     * 新增課程內容
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createCourseContent($courseId)
    {
        return view('teacher/createCourseContent', ['courseId' => $courseId]);
    }

    /**
     * 儲存課程內容
     *
     * @param  \Illuminate\Http\Request\StoreCourseContent  $request
     * @param  int  $courseId
     * @return \Illuminate\Http\Response
     */
    public function storeCourseContent(StoreCourseContent $request, $courseId)
    {
        CourseContent::create($request->all());
        return Redirect::to("/teacher/courses");
    }

    /**
     * 更新課程內容
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCourseContent($id)
    {
        $courseContent = CourseContent::where('id', '=', $id)->get()->toArray();
        $result = [
            'id' => $id,
            'courseContent'=> $courseContent,
        ];
        return view('teacher/updateCourseContent', $result);
    }

    /**
     * 儲存更新課程內容
     *
     * @param  \Illuminate\Http\Request\StoreCourseContent  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUpdateCourseContent(StoreCourseContent $request)
    {
        $id = $request->get('id');
        $courseContent = CourseContent::find($id);
        $courseContent->update($request->all());
        return Redirect::to('/teacher/courses');
    }
}
