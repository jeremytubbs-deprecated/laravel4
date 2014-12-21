<?php

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