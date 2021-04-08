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

Route::prefix('admin')->middleware('can:admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/courses', 'Admin\AdminController@coursesList');
    Route::get('/createCourse', 'Admin\AdminController@createCourses');
    Route::get('/destroyCourse/{id}', 'Admin\AdminController@destroyCourse');
    Route::get('/updateCourse/{id}', 'Admin\AdminController@updateCourse');
    Route::get('/showUpdateCourse/{id}', 'Admin\AdminController@showUpdateCourse');
});
