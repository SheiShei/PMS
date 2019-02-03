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

    // brands
    Route::post('/getbrands', 'BrandsController@getBrands'); 
    Route::post('/addbrands', 'BrandsController@addBrands');
    Route::delete('/deletebrands', 'BrandsController@deleteBrands');
    Route::post('/restorebrands', 'BrandsController@restoreBrands'); 
    Route::get('/getTandemsList', 'BrandsController@getTandemsList');
    Route::post('/getBrandJos', 'BrandsController@getBrandJos');
    Route::post('/getOnebrand', 'BrandsController@getOnebrand'); 
    Route::post('/UpdateBrand', 'BrandsController@updateBrand');

    //messages
    Route::post('/addconversation', 'DataController@addconvo');
    Route::post('/getConvoList', 'DataController@getConvoList');
    Route::get('/getConvoMessages', 'DataController@getConvoMessages');
    Route::get('/getMessages', 'DataController@getMessages');
    Route::post('/newMessage', 'DataController@newMessage');
    Route::patch('/updateRead', 'DataController@updateRead');
    Route::post('/sendFiles', 'DataController@sendFiles');
    Route::post('/getConvoUsers', 'DataController@getConvoUsers');
    Route::post('/getNotMembers', 'DataController@getNotMembers');
    Route::post('/addConvoMember', 'DataController@addConvoMember');
    Route::post('/verifyConvoUsers', 'DataController@verifyConvoUsers');
    Route::delete('/removeMember', 'DataController@removeConvoMember');

    //Job Order
    Route::get('/onLoad', 'AdminController@onLoad');
    Route::get('/getJobOrders', 'AdminController@getJobOrders');
    Route::post('/newJobOrderCreative', 'AdminController@createJOCreative');
    Route::post('/newJobOrderWeb', 'AdminController@createJOWeb');
    Route::post('/getJoDetails', 'AdminController@getJoDetails');
    Route::post('/finishJOC', 'AdminController@finishJOC');
    Route::post('/finishJOW', 'AdminController@finishJOW');
    Route::delete('/deletejo', 'AdminController@deletejo');

    //Boards
    Route::post('/newBoard', 'BoardController@newBoard');
    Route::post('/newCard', 'BoardController@newCard');
    Route::post('/newSprint', 'BoardController@newSprint');
    Route::delete('/deleteBoard', 'BoardController@deleteBoard');
    Route::post('/getUserBoards', 'BoardController@getUserBoards');
    Route::post('/createList', 'BoardController@createList');
    Route::post('/getBoardLists', 'BoardController@getBoardLists');
    Route::patch('/updateList', 'BoardController@updateList');
    Route::delete('/deleteList', 'BoardController@deleteList');
    Route::patch('/updateListOrder', 'BoardController@updateListOrder');
    Route::post('/getBoardMembers', 'BoardController@getBoardMembers');
    Route::post('/addTask', 'BoardController@addTask');
    Route::post('/getTaskData', 'BoardController@getTaskData');
    Route::patch('/updateTask', 'BoardController@updateTask');
    Route::post('/addAttachment', 'BoardController@addAttachment');
    Route::patch('/taskPhoto', 'BoardController@taskPhoto');
    Route::delete('/deleteTask', 'BoardController@deleteTask');
    Route::patch('/updateTaskOrder', 'BoardController@updateTaskOrder');
    Route::post('/sendComment', 'BoardController@sendComment');
    Route::post('/getComments', 'BoardController@getComments');
    Route::post('/getCBoard', 'BoardController@getCBoard');
    Route::patch('/uBoard', 'BoardController@updateBoard');
    Route::patch('/setAsDoneList', 'BoardController@setAsDoneList');
    Route::post('/verifyBoardUsers', 'BoardController@verifyBoardUsers');
    Route::post('/monitorAddTask', 'BoardController@monitorAddTask');
    Route::post('/monitorRemovedTask', 'BoardController@monitorRemovedTask');
    Route::post('/getBUData', 'BoardController@getBUData');


        //Scrum
    Route::post('/getScrumLists', 'BoardController@getScrumLists');
    Route::post('/addsprint', 'BoardController@addsprint');
    Route::patch('/updateSprint', 'BoardController@updateSprint');
    Route::delete('/deleteSprint', 'BoardController@deleteSprint');
    Route::post('/addSprintTask', 'BoardController@addSprintTask');
    Route::patch('/updateSprintOrder', 'BoardController@updateSprintOrder');
    Route::post('/getSprintTasks', 'BoardController@getSprintTasks');
    Route::patch('/updateSprintTaskOrder', 'BoardController@updateSprintTaskOrder');
    Route::patch('/finishSprint', 'BoardController@finishSprint');


    //testRoute
    Route::post('/testFunc', 'BoardController@testFunc');
    Route::post('/getUserNotifications', 'BoardController@getUserNotifications');
    
    //test Scrum
    Route::post('/newUS', 'BoardController@newUS');
    Route::post('/getUS', 'BoardController@getUS');
    Route::post('/getUSData', 'BoardController@getUSData');
    Route::patch('/updateUS', 'BoardController@updateUS');
    Route::delete('/deleteUS', 'BoardController@deleteUS');
    Route::post('/monitorTask', 'BoardController@monitorTask');
    Route::post('/monitorUS', 'BoardController@monitorUS');
    Route::post('/monitorRemovedUS', 'BoardController@monitorRemovedUS');
    Route::post('/getBD', 'BoardController@getBD');

});