<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Purchase;
use App\Models\Cart;
use App\Models\CourseContent;
use App\Models\TeacherCourse;
use App\Models\StudentCourse;
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
        $purchaseCount = Purchase::count();

        $dataForm = [
            'courseCount' => $courseCount,
            'studentCount' => $studentCount,
            'teacherCount' => $teacherCount,
            'purchaseCount' => $purchaseCount,
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
        return view('admin/course/courseList', $result);
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
     * 後台顯示所有的訂單
     *
     * @return \Illuminate\Http\Response
     */
    public function purchaseList()
    {
        $purchases = Purchase::all()->toArray();
        $result = ['records' => $purchases];
        return view('admin/purchase/purchaseList', $result);
    }

    /**
     * 後台顯示所有的課程內容
     *
     * @return \Illuminate\Http\Response
     */
    public function courseContentList()
    {
        $courseContents = CourseContent::all()->toArray();
        $result = ['records' => $courseContents];
        return view('admin/course_content/courseContentList', $result);
    }

    /**
     * 後台顯示所有老師的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function teacherCourseList()
    {
        $teacherCourses = TeacherCourse::all()->toArray();
        $result = ['records' => $teacherCourses];
        return view('admin/teacherCourse/teacherCourseList', $result);
    }

    /**
     * 後台顯示所有老師的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function studentCourseList()
    {
        $studentCourses = StudentCourse::all()->toArray();
        $result = ['records' => $studentCourses];
        return view('admin/studentCourse/studentCourseList', $result);
    }

    /**
     * 新增課程頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCourses()
    {
        return view('admin/course/createCourse');
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
     * 新增訂單頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createPurchase()
    {
        return view('admin/purchase/createPurchase');
    }

    /**
     * 新增課程內容頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCourseContent()
    {
        return view('admin/course_content/createCourseContent');
    }

    /**
     * 新增老師課程頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createTeacherCourse()
    {
        return view('admin/teacherCourse/createTeacherCourse');
    }

    /**
     * 新增學生課程頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createStudentCourse()
    {
        return view('admin/studentCourse/createStudentCourse');
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
        return view('admin/course/updateCourse', $result);
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
     * 更新購物車資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePurchase(Request $request, $id)
    {
        $purchaseForm = [
            'user_id' => $request->get('user_id'),
            'course_id' => $request->get('course_id'),
            'course_name' => $request->get('course_name'),
            'price' => $request->get('price'),
        ];

        $purchase = Purchase::find($id);
        $status = $purchase->update($purchaseForm);
        return Redirect::to('/admin/purchases');
    }

    /**
     * 更新課程內容資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCourseContent(Request $request, $id)
    {
        $courseContentForm = [
            'course_id' => $request->get('course_id'),
            'content_sequence' => $request->get('content_sequence'),
            'content_chapter_name' => $request->get('content_chapter_name'),
            'content' => $request->get('content'),
            'YouTube' => $request->get('YouTube'),
        ];

        $courseContent = CourseContent::find($id);
        $status = $courseContent->update($courseContentForm);
        return Redirect::to('/admin/courseContents');
    }

    /**
     * 更新老師的課程資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTeacherCourse(Request $request, $id)
    {
        $teacherCourseForm = [
            'course_id' => $request->get('course_id'),
            'teacher_id' => $request->get('teacher_id'),
        ];

        $teacherCourse = TeacherCourse::find($id);
        $status = $teacherCourse->update($teacherCourseForm);
        return Redirect::to('/admin/teacherCourses');
    }

    /**
     * 更新學生的課程資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStudentCourse(Request $request, $id)
    {
        $studentCourseForm = [
            'course_id' => $request->get('course_id'),
            'student_id' => $request->get('student_id'),
        ];

        $studentCourse = StudentCourse::find($id);
        $status = $studentCourse->update($studentCourseForm);
        return Redirect::to('/admin/studentCourses');
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
     * 顯示更新購物車頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdatePurchase($id)
    {
        $purchase = Purchase::find($id)->toArray();
        $result = ['records' => $purchase];
        return view('admin/purchase/updatePurchase', $result);
    }

    /**
     * 顯示更新課程資訊頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateCourseContent($id)
    {
        $courseContent = CourseContent::find($id)->toArray();
        $result = ['records' => $courseContent];
        return view('admin/course_content/updateCourseContent', $result);
    }

    /**
     * 顯示更新老師的課程頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateTeacherCourse($id)
    {
        $teacherCourse = TeacherCourse::find($id)->toArray();
        $result = ['records' => $teacherCourse];
        return view('admin/teacherCourse/updateTeacherCourse', $result);
    }

    /**
     * 顯示更新學生的課程頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateStudentCourse($id)
    {
        $studentCourse = StudentCourse::find($id)->toArray();
        $result = ['records' => $studentCourse];
        return view('admin/studentCourse/updateStudentCourse', $result);
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
     * 刪除訂單
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPurchase($id)
    {
        $cart = Purchase::find($id);
        $status = $cart->delete();
        return Redirect::to('/admin/purchases');
    }

    /**
     * 刪除課程內容
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCourseContent($id)
    {
        $courseContent = CourseContent::find($id);
        $status = $courseContent->delete();
        return Redirect::to('/admin/courseContents');
    }

    /**
     * 刪除老師的課程
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTeacherCourse($id)
    {
        $teacherCourse = TeacherCourse::find($id);
        $status = $teacherCourse->delete();
        return Redirect::to('/admin/teacherCourses');
    }

    /**
     * 刪除學生的課程
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyStudentCourse($id)
    {
        $studentCourse = StudentCourse::find($id);
        $status = $studentCourse->delete();
        return Redirect::to('/admin/studentCourses');
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

    /**
     * 儲存訂單
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePurchase(Request $request)
    {
        $purchaseForm = [
            'course_id' => $request->get('course_id'),
            'user_id' => $request->get('user_id'),
            'course_name' => $request->get('course_name'),
            'price' => $request->get('price'),
        ];
        $status = Purchase::create($purchaseForm);
        return Redirect::to('/admin/purchases');
    }

    /**
     * 儲存課程資料
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCourseContent(Request $request)
    {
        $courseContentForm = [
            'course_id' => $request->get('course_id'),
            'content_sequence' => $request->get('content_sequence'),
            'content_chapter_name' => $request->get('content_chapter_name'),
            'content' => $request->get('content'),
            'YouTube' => $request->get('YouTube'),
        ];
        $status = CourseContent::create($courseContentForm);
        return Redirect::to('/admin/courseContents');
    }

    /**
     * 儲存老師的課程
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTeacherCourse(Request $request)
    {
        $teacherCourseForm = [
            'teacher_id' => $request->get('teacher_id'),
            'course_id' => $request->get('course_id'),
        ];
        $status = TeacherCourse::create($teacherCourseForm);
        return Redirect::to('/admin/teacherCourses');
    }

    /**
     * 儲存學生的課程
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStudentCourse(Request $request)
    {
        $studentCourseForm = [
            'student_id' => $request->get('student_id'),
            'course_id' => $request->get('course_id'),
        ];
        $status = StudentCourse::create($studentCourseForm);
        return Redirect::to('/admin/studentCourses');
    }
}
