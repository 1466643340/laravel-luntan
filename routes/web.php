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

Route::get('/register','UserController@register');
Route::post('/register','UserController@handleRegister');

Route::get('/login','UserController@login');
Route::post('/login','UserController@handleLogin');
Route::get('/logout','UserController@logout');
Route::get('/homePage/{id}','UserController@homePage');
Route::post('/homePage/{id}','UserController@handleHomePage');

Route::get('/posts','PostController@index');

Route::get('/posts/id/message','PostController@create');
Route::post('/posts/id/message','PostController@store')->middleware('checkLogin');

// Route::get('/posts/{posts}',function(){
//     echo route('posts.show',['posts'=>1]);
// })->name('posts.show');
Route::get('/posts/{id}','PostController@details');
Route::post('/posts/{id}','PostController@handleDetails')->middleware('checkLogin');

Route::post('/doLike/post','PostController@doLike');

Route::post('views/post','PostController@views');

Route::post('/reply/post','ReplyController@replyDoLike');
