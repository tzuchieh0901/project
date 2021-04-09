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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/courses', 'CourseController@store');
Route::resource('/courses', 'CourseController');
Route::get('/course/{id}', 'CourseController@courseDetail');
Route::put('/course/{id}', 'CourseController@update');


// 使用者擁有的課程
Route::get('/myCourses', 'HomeController@myCourse');


// 只有admin才可以進入
Route::prefix('admin')->middleware('can:admin')->group(function () {

    // index
    Route::get('/', 'Admin\AdminController@index');

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
});
