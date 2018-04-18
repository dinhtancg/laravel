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

Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'firstlogin']], function() {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::group(['prefix' => 'users'],function (){
//        Route::get('','Admin\UserController@index')->name('admin.user.index');
        Route::get('create','Admin\UserController@create')->name('admin.user.create');
        Route::post('create', 'Admin\UserController@createUser')-> name('admin.user.createUser');
        Route::get('edit/{id}', 'Admin\UserController@edit')->name('admin.user.edit');
        Route::delete('', 'Admin\UserController@destroy')->name('admin.user.destroy');
        Route::get('change-password/{id}', function (){})->name('admin.user.changepassword');
    });
});

Route::prefix('send-mail')->group(function (){
    Route::get('','EmailController@sendMail')->name('admin.emails.welcomemail');

});