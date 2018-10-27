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

// Route::get('/', function () {
//     return view('admin/dash-admin');
// });

// Route::get('/users', function() {
//     return view('admin/users');
// });
Route::get('/users', function() {
    return view('admin/users');
});
Route::get('/brands', function(){
    return view('/brandsOverview');
});
Route::get('/brands/add', function(){
    return view('/admin/addBrand');
});
Route::get('/brands/jos', function(){
    return view('/JOs');
});
Route::get('/sticky-notes', function(){
    return view('/stickyNotes');
});

// Route::get('/data', 'DataController@index')->name('data');

// Route::get('/addproject', function() {
//     return view('addProject');
// });
Route::get('/new-jo-web', function() {
    return view('newjoWeb');
});

Route::get('/new-jo-crea', function() {
    return view('newjoCrea');
});

Route::get('/view-jo', function() {
    return view('view-jo');
});

Route::get('/add-client', function(){
    return view('admin/addClient');
});

// // Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');