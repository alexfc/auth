<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/me', 'S25\Auth\Controllers\LoginController@loginByToken');
    Route::get('/token', 'S25\Auth\Controllers\LoginController@loginByToken');
    Route::post('/logout', 'S25\Auth\Controllers\LoginController@logout');
    Route::get('/api/user', 'S25\Auth\Controllers\UserController@user');
});
