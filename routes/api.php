<?php

use Illuminate\Http\Request;


Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/check', 'AuthController@filter');

Route::group(['middleware' => ['auth:api']], function () {

    //get current user logged in
    Route::get('/user', function (Request $request) {
        // return auth()->user()->role()->first();
        return response()->json(['user' => auth()->user(), 'role' => auth()->user()->role()->first()]);
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

    //messages
    Route::post('/addconversation', 'DataController@addconvo');
    Route::post('/getConvoList', 'DataController@getConvoList');
    Route::post('/getConvoUsers', 'DataController@getConvoUsers');
    Route::post('/getNotMembers', 'DataController@getNotMembers');
    Route::post('/addConvoMember', 'DataController@addConvoMember');
    Route::post('/verifyConvoUsers', 'DataController@verifyConvoUsers');
    Route::delete('/removeMember', 'DataController@removeConvoMember');

    Route::get('/getConvoMessages', 'DataController@getConvoMessages');
    Route::get('/getMessages', 'DataController@getMessages');
    Route::post('/newMessage', 'DataController@newMessage');
    Route::patch('/updateRead', 'DataController@updateRead');
    Route::post('/sendFiles', 'DataController@sendFiles');


});