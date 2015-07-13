<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// 認証のルート定義
Route::get('auth/login',  'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// 登録のルート定義
Route::get('auth/register',  'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// 認証必須
Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'admin'], function() {
        Route::get('admin', 'AdminController@index');
        Route::group(['prefix' => 'api'], function () {
            Route::resource('user', 'UserController',
                ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
        });
    });
    Route::get('/', 'IndexController@index');

    Route::group(['prefix' => 'api'], function () {
        Route::resource('sheet', 'SheetController',
            ['only' => ['index', 'store', 'update', 'destroy']]);
    });
});
