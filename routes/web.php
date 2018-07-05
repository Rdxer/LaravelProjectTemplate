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

/// 设置 当前用户为 超级用户
Route::get('/i_am_a_super_administrator', 'InitServerController@i_am_a_super_administrator')->name('i_am_a_super_administrator');

/// 欢迎页
Route::get('/', function () {
    return view('welcome');
});

/// 登陆等 路由
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/// 用户管理路由
Route::resource('users', 'UserController')->middleware("role:super-admin");
Route::get('/users/become_admin/{id}', 'UserController@becomeAdmin')->name('users.become_admin')->middleware("role:super-admin");;
Route::get('/users/revoke_admin/{id}', 'UserController@revokeAdmin')->name('users.revoke_admin')->middleware("role:super-admin");;



Route::resource('letters', 'LetterController')->middleware("auth");