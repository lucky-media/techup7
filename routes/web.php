<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('lang/{locale}', 'LocalizationController@index');

Route::get('/admin', 'UserController@index')->name('admin.index')->middleware('role:admin');
Route::get('/admin/{user}/edit', 'UserController@edit')->name('admin.edit')->middleware('role:admin');
Route::patch('/admin/{user}', 'UserController@update')->name('admin.update')->middleware('role:admin');
Route::delete('/admin/{user}', 'UserController@destroy')->name('admin.destroy')->middleware('role:admin');

Route::get('/courses/create', 'CourseController@create')->name('courses.create')->middleware('role:admin,instructor');
Route::post('/courses/store', 'CourseController@store')->name('courses.store')->middleware('role:admin,instructor');
Route::get('/courses/{course}/edit', 'CourseController@edit')->name('courses.edit')->middleware('role:admin,instructor');
Route::patch('/courses/{course}', 'CourseController@update')->name('courses.update')->middleware('role:admin,instructor');
Route::get('/courses/{course}', 'CourseController@show')->name('courses.show');
Route::delete('/courses/{course}', 'CourseController@destroy')->name('courses.destroy')->middleware('role:admin,instructor');
Route::get('/courses', 'CourseController@index')->name('courses.index');

Route::get('/lessons/create/{course}', 'LessonController@create')->name('lessons.create')->middleware('role:admin,instructor');
Route::post('/lessons/store', 'LessonController@store')->name('lessons.store')->middleware('role:admin,instructor');
Route::post('/lessons/image/upload', 'LessonController@uploadImage')->name('lessons.upload');
Route::get('/lessons/{lesson}/edit', 'LessonController@edit')->name('lessons.edit')->middleware('role:admin,instructor');
Route::patch('/lessons/{lesson}', 'LessonController@update')->name('lessons.update')->middleware('role:admin,instructor');
Route::get('/lessons/{lesson}', 'LessonController@show')->name('lessons.show');
Route::delete('/lessons/{lesson}', 'LessonController@destroy')->name('lessons.destroy')->middleware('role:admin,instructor');

Route::post('/reply/store', 'CommentController@reply')->name('comments.reply');
Route::post('/comments/store', 'CommentController@store')->name('comments.store');
Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');
Route::put('/comments/{comment}', 'CommentController@approved')->name('comments.approved')->middleware('role:admin');
Route::get('/comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
Route::patch('/comments/{comment}', 'CommentController@update')->name('comments.update');
Route::patch('/comments/flag/{comment}', 'CommentController@flag')->name('comments.flag');
Route::get('/comments', 'CommentController@index')->name('comments.index')->middleware('role:admin');

Route::get('/categories/create', 'CategoryController@create')->name('categories.create')->middleware('role:admin');
Route::post('/categories/store', 'CategoryController@store')->name('categories.store')->middleware('role:admin');
Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy')->middleware('role:admin');
Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit')->middleware('role:admin');
Route::patch('/categories/{category}', 'CategoryController@update')->name('categories.update')->middleware('role:admin');
Route::get('/categories', 'CategoryController@index')->name('categories.index')->middleware('role:admin');

Route::get('/profiles/{user}/edit', 'ProfileController@edit')->name('profiles.edit');
Route::get('/profiles/{user}', 'ProfileController@show')->name('profiles.show');
Route::patch('/profiles/{user}', 'ProfileController@update')->name('profiles.update');
Route::get('/instructors', 'ProfileController@index')->name('profiles.index');

Route::post('/search/instructors', 'SearchController@searchInstructors')->name('search.instructors');
Route::post('/search/courses', 'SearchController@searchCourses')->name('search.courses');
Route::post('/search/{user}/courses/', 'SearchController@searchCoursesByInstructor')->name('search.coursesByInstructor');
Route::post('/search/{course}', 'SearchController@searchLessonsByCourse')->name('search.lessonsByCourse');

Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/', 'HomeController@index')->name('index');