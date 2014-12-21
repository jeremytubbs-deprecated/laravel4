<?php

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
