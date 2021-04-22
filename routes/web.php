<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'CourseController@home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/courses', 'CourseController@store');
Route::get('/courses', 'CourseController@index');
Route::get('/course/{id}', 'CourseController@courseDetail');
Route::put('/course/{id}', 'CourseController@update');


// 學生
Route::get('/myCourses', 'HomeController@myCourse');
Route::get('/myPurchases', 'HomeController@myPurchases');
Route::get('/carts', 'HomeController@carts');
Route::get('/removeCartItem/{courseId}', 'HomeController@removeCartItem');
Route::get('/addCartItem/{courseId}', 'HomeController@addCartItem');
Route::get('/purchase', 'PurchaseController@store');

Route::get('/classroom/{courseId}', 'ClassroomController@index');
Route::get('/classroom/{courseId}/{content_sequence}', 'ClassroomController@content');

// 老師
Route::prefix('teacher')->middleware('can:teacher')->group(function () {
    Route::get('/', 'Teacher\TeacherController@index');

    // courses
    Route::get('/courses', 'Teacher\TeacherController@coursesList');
    Route::get('/createCourse', 'Teacher\TeacherController@createCourses');
    Route::post('/courses', 'Teacher\TeacherController@teacherStoreCourse');
    Route::get('/destroyCourse/{id}', 'Teacher\TeacherController@destroyCourse');
    Route::get('/updateCourse/{id}', 'Teacher\TeacherController@updateCourse');
    Route::get('/showUpdateCourse/{id}', 'Teacher\TeacherController@showUpdateCourse');

    // course_content
    Route::get('/showUpdateCourseContent/{id}', 'Teacher\TeacherController@showUpdateCourseContent');
    Route::get('/deleteCourseContent/{courseId}/{contentId}', 'Teacher\TeacherController@deleteCourseContent');
    Route::get('/createCourseContent/{courseId}', 'Teacher\TeacherController@createCourseContent');
    Route::post('/storeCourseContent/{courseId}', 'Teacher\TeacherController@storeCourseContent');
    Route::post('/storeUpdateCourseContent/{id}', 'Teacher\TeacherController@storeUpdateCourseContent');
    Route::get('/updateCourseContent/{id}', 'Teacher\TeacherController@updateCourseContent');
});

// admin
Route::prefix('admin')->middleware('can:admin')->group(function () {

    // index
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/dashboard', 'Admin\AdminController@index');

    // courses
    Route::get('/courses', 'Admin\AdminController@coursesList');
    Route::get('/createCourse', 'Admin\AdminController@createCourses');
    Route::get('/destroyCourse/{id}', 'Admin\AdminController@destroyCourse');
    Route::get('/updateCourse/{id}', 'Admin\AdminController@updateCourse');
    Route::get('/showUpdateCourse/{id}', 'Admin\AdminController@showUpdateCourse');

    // student
    Route::get('/students', 'Admin\UserController@studentsList');
    Route::get('/updateStudent/{id}', 'Admin\UserController@updateStudent');
    Route::get('/showUpdateStudent/{id}', 'Admin\UserController@showUpdateStudent');
    Route::get('/destroyStudent/{id}', 'Admin\UserController@destroyStudent');

    // teacher
    Route::get('/teachers', 'Admin\UserController@teachersList');
    Route::get('/destroyTeacher/{id}', 'Admin\UserController@destroyTeacher');
    Route::get('/updateTeacher/{id}', 'Admin\UserController@updateTeacher');
    Route::get('/showUpdateTeacher/{id}', 'Admin\UserController@showUpdateTeacher');

    // cart
    Route::get('/carts', 'Admin\CartController@cartsList');
    Route::get('/destroyCart/{id}', 'Admin\CartController@destroyCart');
    Route::get('/updateCart/{id}', 'Admin\CartController@updateCart');
    Route::get('/showUpdateCart/{id}', 'Admin\CartController@showUpdateCart');
    Route::get('/createCart', 'Admin\CartController@createCart');
    Route::post('/carts', 'Admin\CartController@storeCart');

    // purchase
    Route::get('/purchases', 'Admin\PurchaseController@purchaseList');
    Route::get('/destroyPurchase/{id}', 'Admin\PurchaseController@destroyPurchase');
    Route::get('/updatePurchase/{id}', 'Admin\PurchaseController@updatePurchase');
    Route::get('/showUpdatePurchase/{id}', 'Admin\PurchaseController@showUpdatePurchase');
    Route::get('/createPurchase', 'Admin\PurchaseController@createPurchase');
    Route::post('/purchases', 'Admin\PurchaseController@storePurchase');

    // course_content
    Route::get('/courseContents', 'Admin\AdminController@courseContentList');
    Route::get('/destroyCourseContent/{id}', 'Admin\AdminController@destroyCourseContent');
    Route::get('/updateCourseContent/{id}', 'Admin\AdminController@updateCourseContent');
    Route::get('/showUpdateCourseContent/{id}', 'Admin\AdminController@showUpdateCourseContent');
    Route::get('/createCourseContent', 'Admin\AdminController@createCourseContent');
    Route::post('/courseContents', 'Admin\AdminController@storeCourseContent');

    // teacher_course
    Route::get('/teacherCourses', 'Admin\AdminController@teacherCourseList');
    Route::get('/destroyTeacherCourse/{id}', 'Admin\AdminController@destroyTeacherCourse');
    Route::get('/updateTeacherCourse/{id}', 'Admin\AdminController@updateTeacherCourse');
    Route::get('/showUpdateTeacherCourse/{id}', 'Admin\AdminController@showUpdateTeacherCourse');
    Route::get('/createTeacherCourse', 'Admin\AdminController@createTeacherCourse');
    Route::post('/teacherCourses', 'Admin\AdminController@storeTeacherCourse');

    // student_course
    Route::get('/studentCourses', 'Admin\AdminController@studentCourseList');
    Route::get('/destroyStudentCourse/{id}', 'Admin\AdminController@destroyStudentCourse');
    Route::get('/updateStudentCourse/{id}', 'Admin\AdminController@updateStudentCourse');
    Route::get('/showUpdateStudentCourse/{id}', 'Admin\AdminController@showUpdateStudentCourse');
    Route::get('/createStudentCourse', 'Admin\AdminController@createStudentCourse');
    Route::post('/studentCourses', 'Admin\AdminController@storeStudentCourse');
});
