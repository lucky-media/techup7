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

Route::get('/courses/create', 'CoursesController@create')->middleware('role:admin,instructor');
Route::post('/courses/store', 'CoursesController@store')->middleware('role:admin,instructor');
Route::get('/courses/{course}/edit', 'CoursesController@edit')->name('courses.edit')->middleware('role:admin,instructor');
Route::patch('/courses/{course}', 'CoursesController@update')->name('courses.update')->middleware('role:admin,instructor');
Route::get('/courses/{slug}', 'CoursesController@show')->name('courses.show');
Route::delete('/courses/{course}', 'CoursesController@destroy')->middleware('role:admin,instructor');

Route::get('/lessons/create/{course}', 'LessonsController@create')->middleware('role:admin,instructor');
Route::post('/lessons/store', 'LessonsController@store')->middleware('role:admin,instructor');
Route::get('/lessons/{lesson}/edit', 'LessonsController@edit')->name('lessons.edit')->middleware('role:admin,instructor');
Route::patch('/lessons/{lesson}', 'LessonsController@update')->name('lessons.update')->middleware('role:admin,instructor');
Route::get('/lessons/{slug}', 'LessonsController@show')->name('lessons.show');
Route::delete('/lessons/{lesson}', 'LessonsController@destroy')->middleware('role:admin,instructor');
Route::post('/lessons/image/upload', 'LessonsController@uploadImage');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/instructors', 'HomeController@instructors')->name('instructors');
Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/', 'HomeController@index')->name('index');