<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * 後台顯示所有的學生
     *
     * @return \Illuminate\Http\Response
     */
    public function studentsList()
    {
        $users = User::all()->where('role', '=', 'user')->toArray();
        $result = ['records' => $users];
        return view('admin/student/studentsList', $result);
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
        return view('admin/student/updateStudent', $result);
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

    /**
     * 後台顯示所有的老師
     *
     * @return \Illuminate\Http\Response
     */
    public function teachersList()
    {
        $teachers = User::all()->where('role', '=', 'teacher')->toArray();
        $result = ['records' => $teachers];
        return view('admin/teacher/teachersList', $result);
    }

    /**
     * 刪除老師
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTeacher($id)
    {
        $teacher = User::find($id);
        $status = $teacher->delete();
        return Redirect::to('/admin/teachers');
    }

    /**
     * 更新教師資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTeacher(Request $request, $id)
    {
        $teacherForm = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => 'teacher',
            'password' => Hash::make($request->get('password')),
        ];

        $teacher = User::find($id);
        $status = $teacher->update($teacherForm);
        return Redirect::to('/admin/teachers');
    }

    /**
     * 顯示更新教師頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateTeacher($id)
    {
        $teacher = User::find($id)->toArray();
        $result = ['records' => $teacher];
        return view('admin/teacher/updateTeacher', $result);
    }
}
