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

Route::get('/admin', 'UsersController@index')->middleware('role:admin');
Route::get('/admin/{user}/edit', 'UsersController@edit')->middleware('role:admin');
Route::patch('/admin/{user}', 'UsersController@update')->name('admin.update')->middleware('role:admin');
Route::delete('/admin/{user}', 'UsersController@destroy')->middleware('role:admin');

Route::get('/courses/create', 'CoursesController@create')->middleware('role:admin,instructor');
Route::post('/courses/store', 'CoursesController@store')->middleware('role:admin,instructor');
Route::get('/courses/{course}/edit', 'CoursesController@edit')->name('courses.edit')->middleware('role:admin,instructor');
Route::patch('/courses/{course}', 'CoursesController@update')->name('courses.update')->middleware('role:admin,instructor');
Route::get('/courses/{course}', 'CoursesController@show')->name('courses.show');
Route::delete('/courses/{course}', 'CoursesController@destroy')->middleware('role:admin,instructor');

Route::get('/lessons/create/{course}', 'LessonsController@create')->middleware('role:admin,instructor');
Route::post('/lessons/store', 'LessonsController@store')->middleware('role:admin,instructor');
Route::get('/lessons/{lesson}/edit', 'LessonsController@edit')->name('lessons.edit')->middleware('role:admin,instructor');
Route::patch('/lessons/{lesson}', 'LessonsController@update')->name('lessons.update')->middleware('role:admin,instructor');
Route::get('/lessons/{lesson}', 'LessonsController@show')->name('lessons.show');
Route::delete('/lessons/{lesson}', 'LessonsController@destroy')->middleware('role:admin,instructor');
Route::post('/lessons/image/upload', 'LessonsController@uploadImage');

Route::post('/reply/store', 'CommentsController@reply');
Route::post('/comments/store', 'CommentsController@store');
Route::delete('/comments/{comment}', 'CommentsController@destroy');
Route::put('/comments/{comment}', 'CommentsController@approved')->middleware('role:admin');
Route::get('/comments/{comment}/edit', 'CommentsController@edit');
Route::patch('/comments/{comment}', 'CommentsController@update');
Route::patch('/comments/flag/{comment}', 'CommentsController@flag');
Route::get('/comments', 'CommentsController@index')->middleware('role:admin');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/instructors', 'HomeController@instructors')->name('instructors');
Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/', 'HomeController@index')->name('index');