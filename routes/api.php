<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/answers/{answer}/like', 'LikeController@like')->name('like');
Route::post('/answers/{answer}/unlike', 'LikeController@unlike')->name('unlike');

Route::post('/posts/{post}/good', 'GoodController@good')->name('good');
Route::post('/posts/{post}/ungood', 'GoodController@ungood')->name('ungood');
Route::post('/posts/{post}/solve', 'SolveController@solve')->name('solve');
