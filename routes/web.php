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

Route::get('/admin', 'UsersController@index')->name('admin.index')->middleware('role:admin');
Route::get('/admin/{user}/edit', 'UsersController@edit')->name('admin.edit')->middleware('role:admin');
Route::patch('/admin/{user}', 'UsersController@update')->name('admin.update')->middleware('role:admin');
Route::delete('/admin/{user}', 'UsersController@destroy')->name('admin.destroy')->middleware('role:admin');

Route::get('/courses/create', 'CoursesController@create')->name('courses.create')->middleware('role:admin,instructor');
Route::post('/courses/store', 'CoursesController@store')->name('courses.store')->middleware('role:admin,instructor');
Route::get('/courses/{course}/edit', 'CoursesController@edit')->name('courses.edit')->middleware('role:admin,instructor');
Route::patch('/courses/{course}', 'CoursesController@update')->name('courses.update')->middleware('role:admin,instructor');
Route::get('/courses/{course}', 'CoursesController@index')->name('courses.index');
Route::delete('/courses/{course}', 'CoursesController@destroy')->name('courses.destroy')->middleware('role:admin,instructor');

Route::get('/lessons/create/{course}', 'LessonsController@create')->name('lessons.create')->middleware('role:admin,instructor');
Route::post('/lessons/store', 'LessonsController@store')->name('lessons.store')->middleware('role:admin,instructor');
Route::get('/lessons/{lesson}/edit', 'LessonsController@edit')->name('lessons.edit')->middleware('role:admin,instructor');
Route::patch('/lessons/{lesson}', 'LessonsController@update')->name('lessons.update')->middleware('role:admin,instructor');
Route::get('/lessons/{lesson}', 'LessonsController@index')->name('lessons.index');
Route::delete('/lessons/{lesson}', 'LessonsController@destroy')->name('lessons.destroy')->middleware('role:admin,instructor');
Route::post('/lessons/image/upload', 'LessonsController@uploadImage')->name('lessons.upload');

Route::post('/reply/store', 'CommentsController@reply')->name('comments.reply');
Route::post('/comments/store', 'CommentsController@store')->name('comments.store');
Route::delete('/comments/{comment}', 'CommentsController@destroy')->name('comments.destroy');
Route::put('/comments/{comment}', 'CommentsController@approved')->name('comments.approved')->middleware('role:admin');
Route::get('/comments/{comment}/edit', 'CommentsController@edit')->name('comments.edit');
Route::patch('/comments/{comment}', 'CommentsController@update')->name('comments.update');
Route::patch('/comments/flag/{comment}', 'CommentsController@flag')->name('comments.flag');
Route::get('/comments', 'CommentsController@index')->name('comments.index')->middleware('role:admin');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.index');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/instructors', 'HomeController@instructors')->name('instructors');
Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/', 'HomeController@index')->name('index');