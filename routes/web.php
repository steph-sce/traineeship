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


// ------------- Routes du front -------------
Route::get('/', 'FrontController@index')->name('index');
Route::get('/post/{post}', 'FrontController@show')->where(['post', '[0-9]+'])->name('show');
Route::get('/stages', 'FrontController@showStages')->name('stages');
Route::get('/formations', 'FrontController@showFormations')->name('formations');
Route::get('/contact', 'FrontController@contact')->name('contact');
// -------------------------------------------



// ------------- Routes de la gestion d'email -------------
Route::post('/contact', 'MailController@sendContactMail')->name('sendContactMail');


// --------------------------------------------------------


// ------------- Routes du back -------------
Route::resource('admin/post', 'PostController')->middleware('auth');
Route::get('admin/post/trash/{post}', 'PostController@setTrash')->middleware('auth')->name('trash');
Route::get('admin/post/draft/{post}', 'PostController@setDraft')->middleware('auth')->name('draft');
Route::get('admin/trash', 'PostController@showTrash')->middleware('auth')->name('showTrash');
// ------------------------------------------


// ------------- Routes autogénérées par make:auth -------------
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// -------------------------------------------------------------
