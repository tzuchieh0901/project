<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    /**
     * 顯示所有的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all()->toArray();
        $result = ['records' => $courses];
        return view('courses', $result);
    }

    /**
     * 顯示單一課程的詳細資料
     *
     * @return \Illuminate\Http\Response
     */
    public function courseDetail($id)
    {
        $course = Course::find($id)->toArray();
        $result = ['records' => $course];

        return view('course', $result);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $courseForm = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'outline' => $request->get('outline'),
        ];
        $status = Course::create($courseForm);
        return Redirect::to('/admin/courses');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
