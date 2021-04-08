<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
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
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCourses()
    {
        return view('Admin/createCourse');
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
     * 顯示更新課程資訊
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
     * Remove the specified resource from storage.
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
}
