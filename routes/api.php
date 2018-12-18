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

    // users
    Route::post('/shittycaptivateusers', 'AdminController@getUsersList');
    Route::post('/addusers', 'AdminController@addUsers');
    Route::patch('/updateuser', 'AdminController@updateUser');
    Route::delete('/deleteuser', 'AdminController@deleteUser');
    Route::post('/restoreuser', 'AdminController@restoreUser');

    // notes
    Route::post('/usernotes', 'DataController@getNotes');
    Route::patch('/updatenoteorder', 'DataController@updateNoteOrder');
    Route::patch('/updatenote', 'DataController@updateNote');
    Route::post('/addnote', 'DataController@addNote');
    Route::delete('/deletenote', 'DataController@deleteNote');

    // brands
    Route::post('/getbrands', 'BrandsController@getBrands'); 
    Route::post('/addbrands', 'BrandsController@addBrands');
    Route::delete('/deletebrands', 'BrandsController@deleteBrands');
    Route::post('/restorebrands', 'BrandsController@restoreBrands');
    Route::get('/getTandemsList', 'BrandsController@getTandemsList');
    Route::post('/getBrandJos', 'BrandsController@getBrandJos');
    //messages
    Route::post('/addconversation', 'DataController@addconvo');
    Route::post('/getConvoList', 'DataController@getConvoList');


    //Job Order
    Route::get('/onLoad', 'AdminController@onLoad');
    Route::get('/getJobOrders', 'AdminController@getJobOrders');
    Route::post('/newJobOrderCreative', 'AdminController@createJOCreative');
    Route::post('/newJobOrderWeb', 'AdminController@createJOWeb');
    // Route::post('/updateJobOrderCreative', 'AdminController@updateJOCreative');
    // Route::post('/updateJobOrderWeb', 'AdminController@updateJOWeb');
    Route::post('/getJoDetails', 'AdminController@getJoDetails');
    Route::post('/finishJOC', 'AdminController@finishJOC');
    Route::post('/finishJOW', 'AdminController@finishJOW');
    Route::delete('/deletejo', 'AdminController@deletejo');


    //Boards
    Route::post('/newBoard', 'BoardController@newBoard');
    Route::post('/newCard', 'BoardController@newCard');
    Route::post('/newSprint', 'BoardController@newSprint');
    Route::delete('/deleteBoard', 'AdminController@deleteBoard');

});