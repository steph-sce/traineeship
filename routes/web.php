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

Route::get('/', 'FrontController@index')->name('index');
Route::get('/post/{post}', 'FrontController@show')->where(['post', '[0-9]+'])->name('show');
Route::get('/stages', 'FrontController@showStages')->name('stages');
Route::get('/formations', 'FrontController@showFormations')->name('formations');
Route::get('/contact', 'FrontController@contact')->name('contact');

Route::resource('admin/post', 'PostController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
