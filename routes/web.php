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
    Route::get('/students', 'Admin\AdminController@studentsList');
    Route::get('/createStudent', 'Admin\AdminController@createStudent');
    Route::get('/updateStudent/{id}', 'Admin\AdminController@updateStudent');
    Route::get('/showUpdateStudent/{id}', 'Admin\AdminController@showUpdateStudent');
    Route::get('/destroyStudent/{id}', 'Admin\AdminController@destroyStudent');

    // teacher
    Route::get('/teachers', 'Admin\AdminController@teachersList');
    Route::get('/destroyTeacher/{id}', 'Admin\AdminController@destroyTeacher');
    Route::get('/updateTeacher/{id}', 'Admin\AdminController@updateTeacher');
    Route::get('/showUpdateTeacher/{id}', 'Admin\AdminController@showUpdateTeacher');

    // cart
    Route::get('/carts', 'Admin\AdminController@cartsList');
    Route::get('/destroyCart/{id}', 'Admin\AdminController@destroyCart');
    Route::get('/updateCart/{id}', 'Admin\AdminController@updateCart');
    Route::get('/showUpdateCart/{id}', 'Admin\AdminController@showUpdateCart');
    Route::get('/createCart', 'Admin\AdminController@createCart');
    Route::post('/carts', 'Admin\AdminController@storeCart');

    // purchase
    Route::get('/purchases', 'Admin\AdminController@purchaseList');
    Route::get('/destroyPurchase/{id}', 'Admin\AdminController@destroyPurchase');
    Route::get('/updatePurchase/{id}', 'Admin\AdminController@updatePurchase');
    Route::get('/showUpdatePurchase/{id}', 'Admin\AdminController@showUpdatePurchase');
    Route::get('/createPurchase', 'Admin\AdminController@createPurchase');
    Route::post('/purchases', 'Admin\AdminController@storePurchase');

    // course_content
    Route::get('/courseContents', 'Admin\AdminController@courseContentList');
    Route::get('/destroyCourseContent/{id}', 'Admin\AdminController@destroyCourseContent');
    Route::get('/updateCourseContent/{id}', 'Admin\AdminController@updateCourseContent');
    Route::get('/showUpdateCourseContent/{id}', 'Admin\AdminController@showUpdateCourseContent');
    Route::get('/createCourseContent', 'Admin\AdminController@createCourseContent');
    Route::post('/courseContents', 'Admin\AdminController@storeCourseContent');
});
