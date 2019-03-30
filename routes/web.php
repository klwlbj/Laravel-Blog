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
Route::get('/posts/create','\App\Http\Controllers\PostController@create');
Route::post('/posts','\App\Http\Controllers\PostController@store');//文章创建

//路由有先后顺序，文章创建的get和文章详情的get会冲突，要把它放在前面
Route::get('/posts/search','\App\Http\Controllers\PostController@search');//search，
Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');//文章详情页

Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}','\App\Http\Controllers\PostController@update');//文章编辑
Route::get('/posts/{post}/delete','\App\Http\Controllers\PostController@delete');//文章del
Route::post('/posts/image/upload','\App\Http\Controllers\PostController@imageUpload');//pic up

//用户登录注册模块
Route::get('/register','\App\Http\Controllers\RegisterController@index');//注册
Route::post('/register','\App\Http\Controllers\RegisterController@register');//注册行为
Route::get('/login','\App\Http\Controllers\LoginController@index');//注册
Route::post('/login','\App\Http\Controllers\LoginController@login');//登录行为
Route::get('/logout','\App\Http\Controllers\LoginController@logout');//注销行为
////个人中心模块
Route::get('/user/setting','\App\Http\Controllers\UserController@setting');//个人设置
Route::post('/user/setting','\App\Http\Controllers\UserController@settingStore');//个人设置操作
Route::get('/user/{user}','\App\Http\Controllers\UserController@show');//个人中心
Route::post('/user/{user}/fan','\App\Http\Controllers\UserController@fan');//个人中心关注
Route::post('/user/{user}/unfan','\App\Http\Controllers\UserController@unfan');//个人中心取消关注

//评论和赞模块
Route::post('/posts/{post}/comment','\App\Http\Controllers\PostController@comment');//提交评论
Route::get('/posts/{post}/zan','\App\Http\Controllers\PostController@zan');//赞
Route::get('/posts/{post}/unzan','\App\Http\Controllers\PostController@unzan');//取消赞
//专题详情页
Route::get('/topic/{topic}','\App\Http\Controllers\TopicController@show');
Route::post('/topic/{topic}/submit','\App\Http\Controllers\TopicController@submit');//提交评论


include_once ('admin.php');

