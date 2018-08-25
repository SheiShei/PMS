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
    return view('admin/dash-admin');
});

Route::get('/users', function() {
    return view('admin/users');
});

Route::get('/addproject', function() {
    return view('addProject');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
