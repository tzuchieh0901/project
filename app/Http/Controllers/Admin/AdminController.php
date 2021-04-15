<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Cart;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseCount = Course::count();
        $studentCount = User::where('role', '=', 'user')->count();
        $teacherCount = User::where('role', '=', 'teacher')->count();
        $dataForm = [
            'courseCount' => $courseCount,
            'studentCount' => $studentCount,
            'teacherCount' => $teacherCount,
        ];
        return view('admin/dashboard', $dataForm);
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
        return view('admin/student/studentsList', $result);
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
     * 後台顯示所有的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function coursesList()
    {
        $courses = Course::all()->toArray();
        $result = ['records' => $courses];
        return view('admin/courseList', $result);
    }

    /**
     * 後台顯示所有的購物車
     *
     * @return \Illuminate\Http\Response
     */
    public function cartsList()
    {
        $carts = Cart::all()->toArray();
        $result = ['records' => $carts];
        return view('admin/cart/cartList', $result);
    }

    /**
     * 新增課程頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCourses()
    {
        return view('admin/createCourse');
    }

    /**
     * 新增購物車頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCart()
    {
        return view('admin/cart/createCart');
    }

    /**
     * 新增學生頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createStudent()
    {
        return view('admin/student/createStudent');
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
        return view('admin/updateCourse', $result);
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
     * 更新購物車資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request, $id)
    {
        $cartForm = [
            'user_id' => $request->get('user_id'),
            'course_id' => $request->get('course_id'),
        ];

        $cart = Cart::find($id);
        $status = $cart->update($cartForm);
        return Redirect::to('/admin/carts');
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

    /**
     * 顯示更新購物車頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateCart($id)
    {
        $cart = Cart::find($id)->toArray();
        $result = ['records' => $cart];
        return view('admin/cart/updateCart', $result);
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
     * 刪除購物車
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCart($id)
    {
        $cart = Cart::find($id);
        $status = $cart->delete();
        return Redirect::to('/admin/carts');
    }

    /**
     * 儲存購物車
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCart(Request $request)
    {
        $cartForm = [
            'course_id' => $request->get('course_id'),
            'user_id' => $request->get('user_id'),
        ];
        $status = Cart::create($cartForm);
        return Redirect::to('/admin/carts');
    }
}
