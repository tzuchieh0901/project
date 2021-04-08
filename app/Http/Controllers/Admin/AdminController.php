<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin/admin');
    }

    /**
     * 後台顯示所有的學生
     *
     * @return \Illuminate\Http\Response
     */
    public function studentsList()
    {
        $users = User::all()->where('role', '=', 'user')->toArray();
        $result = ['records' => $users];
        return view('Admin/student/studentsList', $result);
    }

    /**
     * 後台顯示所有的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function coursesList()
    {
        $courses = Course::all()->toArray();
        $result = ['records' => $courses];
        return view('Admin/courseList', $result);
    }

    /**
     * 新增課程頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCourses()
    {
        return view('Admin/createCourse');
    }

    /**
     * 新增學生頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createStudent()
    {
        return view('Admin/student/createStudent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        ];

        $course = Course::find($id);
        $status = $course->update($request->toArray());
        return Redirect::to('/admin/courses');
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
        return view('Admin/updateCourse', $result);
    }

    /**
     * 更新學生資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request, $id)
    {
        $studentForm = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => 'user',
            'password' => Hash::make($request->get('password')),
        ];

        $student = User::find($id);
        $status = $student->update($studentForm);
        return Redirect::to('/admin/students');
    }

    /**
     * 顯示更新學生頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateStudent($id)
    {
        $student = User::find($id)->toArray();
        $result = ['records' => $student];
        return view('Admin/student/updateStudent', $result);
    }

    /**
     * 刪除課程
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCourse($id)
    {
        $course = Course::find($id);
        $status = $course->delete();
        return Redirect::to('/admin/courses');
    }

    /**
     * 刪除學生
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyStudent($id)
    {
        $student = User::find($id);
        $status = $student->delete();
        return Redirect::to('/admin/students');
    }
}
