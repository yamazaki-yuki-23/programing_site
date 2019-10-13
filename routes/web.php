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

Route::get('/', 'TopController@index')->name('top');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/young', 'BoyController@index')->name('young');
Route::get('/young/add', 'BoyController@add')->name('young-add');

Route::post('/young', 'BoyController@store')->middleware('auth');

Route::get('/post', 'PostController@index')->name('post'); 
// Route::get('/change', 'ChangepostsController@index')->name('change');
Route::get('/young/show/{post_id}', 'BoyController@show')->name('show');
Route::match(['get', 'post'], '/answer', 'AnswersController@store')->name('answer');
Route::match(['get', 'post'], '/search', 'SearchController@index')->name('search');
Route::get('/nav/{item}', 'NavController@index')->name('nav');
Route::get('/nosign','AnswersController@index')->name('no-sign');
Route::get('/warn', 'WarnController@index')->name('warn');
Route::get('/getLogout', 'UserController@getLogout')->name('getLogout');
Route::get('/mypage', 'UserController@mypage')->name('mypage');
Route::get('/mypage/question_list', 'UserController@question_list')->name('question_list');
Route::get('/mypage/answer_list', 'UserController@question_list')->name('answer_list');