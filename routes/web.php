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

//文章模块
Route::get('/posts','\App\Http\Controllers\PostController@index');//文章列表页
Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');//文章详情页
Route::get('/posts-create','\App\Http\Controllers\PostController@create');
Route::post('/posts','\App\Http\Controllers\PostController@store');//文章创建
Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}','\App\Http\Controllers\PostController@update');//文章编辑
Route::get('/posts/{post}/delete','\App\Http\Controllers\PostController@delete');//文章del
Route::post('/posts/image/upload','\App\Http\Controllers\PostController@imageUpload');//pic up

//用户模块
Route::get('/register','\App\Http\Controllers\RegisterController@index');//注册
Route::post('/register','\App\Http\Controllers\RegisterController@register');//注册行为
Route::get('/login','\App\Http\Controllers\LoginController@index');//注册
Route::post('/login','\App\Http\Controllers\LoginController@login');//登录行为
Route::get('/logout','\App\Http\Controllers\LoginController@logout');//注销行为
Route::get('/user/setting','\App\Http\Controllers\UserController@setting');//个人设置
Route::post('/user/setting','\App\Http\Controllers\UserController@settingStore');//个人设置操作
//评论模块
Route::post('/posts/{post}/comment','\App\Http\Controllers\PostController@comment');//提交评论


