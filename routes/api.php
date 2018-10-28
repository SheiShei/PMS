<?php

use Illuminate\Http\Request;


Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/check', 'AuthController@filter');

Route::group(['middleware' => ['auth:api']], function () {

    //get current user logged in
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //obviously for logout function
    Route::post('/logout', 'AuthController@logout');
    Route::post('/logoutall', 'AuthController@logoutAll');   

});