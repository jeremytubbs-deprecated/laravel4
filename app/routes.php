<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// login, logout, and register
Route::get('register', ['as' => 'register', 'uses' => 'RegistrationController@getRegister']);
Route::post('register', ['as' => 'register', 'uses' => 'RegistrationController@postRegister']);
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
Route::post('login', ['as' => 'login', 'uses' => 'AuthController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
//Facebook Login
Route::get('facebook/connect', ['as' => 'facebook', 'uses' => 'FacebookController@createFacebook']);
Route::get('facebook/login', ['as' => 'facebookStore', 'uses' => 'FacebookController@storeFacebook']);
// Password Resets
Route::get('remind', ['as' => 'remind', 'uses' => 'RemindersController@getRemind']);
Route::post('remind', ['as' => 'remind', 'uses' => 'RemindersController@postRemind']);
Route::get('password/reset/{token}', ['as' => 'reset', 'uses' => 'RemindersController@getReset']);
Route::post('password/reset/{token}', ['as' => 'reset', 'uses' => 'RemindersController@postReset']);

//Admin Area
Route::group(['before' => 'auth|group:admin', 'prefix' => 'admin'], function() {
    Route::get('', ['as' => 'dashboard', 'uses' => 'AdminController@index']);
    //Groups Routes
    Route::resource('groups', 'GroupsController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    //Users Routes
    Route::resource('users', 'UsersController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::post('assignGroup/{id}/{group_id}', 'UsersController@assignGroup');
    Route::post('removeGroup/{id}/{group_id}', 'UsersController@removeGroup');
});