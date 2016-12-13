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

//前台
Route::group(['namespace' => 'Web','prefix' => '/' ,'middleware' => ['web']],function(){
    Route::get('/', 'HomeController@index');
    Route::resource('article', 'ArticlesController');
    Route::resource('logs', 'LogsController');
});

//认证
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\LoginController@login');
Route::get('admin/logout', 'Admin\LoginController@logout');
//后台
Route::group(['namespace' => 'Admin','prefix' => 'admin' ,'middleware' => ['auth.admin']],function(){
    Route::get('/', 'IndexController@index');
    //菜单
    Route::resource('menu', 'MenuController');
    //权限组
    Route::resource('role', 'RoleController');
    //权限节点
    Route::resource('permission', 'PermissionController');
    //管理员
    Route::resource('admin', 'AdminController');
    //用户
    Route::resource('user', 'UserController');
});

