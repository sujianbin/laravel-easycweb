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

Route::group(['namespace'=>'Home','prefix'=>'index'], function () {
    Route::get('index','IndexController@index');
});

Route::group(['middleware'=>'admin.permission','namespace'=>'Admin\Test','prefix'=>'test'], function () {
    Route::get('test','TestController@index');
});

Route::group(['namespace'=>'Admin','prefix'=>'admin'], function () {

    Route::any('login','LoginController@index')->name('login');
    Route::get('test','IndexController@test');

    Route::group(['middleware'=>['admin','admin.permission']], function () {
        Route::get('/','IndexController@index');
        Route::get('index','IndexController@index');
        Route::get('centos','IndexController@centos');
        //角色管理
        Route::group(['prefix'=>'role'], function () {
            Route::resource("role",'RoleController',['except'=>['show']]);
        });
        //权限管理
        Route::group(['prefix'=>'rights'], function () {
            Route::resource("rights",'SystemRightController',['except'=>['show']]);
            Route::post('getAllController','SystemRightController@getAllController');
            Route::post('getControllerMethod','SystemRightController@getControllerMethod');
        });
    });
});
