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

Route::get('/test', function () {
    return view('test');
});

//文章模块
//文章列表页
Route::get('/posts', '\App\Http\Controllers\PostController@index');
//创建文章 只显示模版
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
//保存逻辑
Route::post('/posts', '\App\Http\Controllers\PostController@store');
//文章详情页
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
//编辑文章
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit')->name('post.edit');
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
//图片上传
Route::post('/posts/image/upload', '\App\Http\Controllers\PostController@imageUpload');
//删除
Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');

//用户模块
//注册页面
Route::get('/register', 'RegisterController@index');
//注册行为
Route::post('/register', 'RegisterController@register');
//登录页面
Route::get('/login', 'LoginController@index');
//登录行为
Route::post('/login', 'LoginController@login');
//登出行为
Route::get('/logout', 'LoginController@logout');
//个人设置页面
Route::get('/user/me/setting', 'UserController@setting');
//个人设置操作
Route::post('/user/me/setting', 'UserController@settingStore');
