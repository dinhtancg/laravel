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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function() {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
});
Route::group(['prefix' => 'users','middleware' => 'auth'],function (){
    Route::get('','Admin\UserController@index')->name('admin.User.index');
    Route::get('create','Admin\UserController@create')->name('admin.User.create');
    Route::post('create', 'Admin\UserController@createUser')-> name('admin.User.createUser');
    Route::get('edit/{id}', 'Admin\UserController@edit')->name('admin.User.edit');
    Route::delete('', 'Admin\UserController@destroy')->name('admin.User.destroy');
});