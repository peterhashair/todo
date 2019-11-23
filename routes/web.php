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
Route::resource('task', 'TaskController')->except('edit', 'index');
Route::get("/home/tasks", 'HomeController@getTask');
Route::put("/home/tasks/{id}", 'HomeController@changeTaskStatus');
Route::get("/home/log", 'LogController@index')->name('log.home');
