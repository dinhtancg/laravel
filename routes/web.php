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

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::group(['prefix' => 'category','middleware' => 'role:root'],function (){
        Route::get('', 'Admin\CategoryController@index')->name('admin.category.index')->middleware('can:category-list');
        Route::get('create','Admin\CategoryController@create')->name('admin.category.create')->middleware('can:category-create');
        Route::post('create', 'Admin\CategoryController@createCategory')-> name('admin.category.createCategory');
        Route::get('edit/{id}', 'Admin\CategoryController@edit')->name('admin.category.edit')->middleware('can:category-edit');
        Route::delete('/{id}', 'Admin\CategoryController@destroy')->name('admin.category.destroy')->middleware('can:category-destroy');
    });
//    Route::group(['prefix' => 'permissions','middleware' => 'role:root'],function (){
//        Route::get('', 'Admin\PermissionController@index')->name('admin.permission.index')->middleware('can:permission-list');
//        Route::get('create','Admin\PermissionController@create')->name('admin.permission.create')->middleware('can:permission-create');
//        Route::post('create', 'Admin\PermissionController@createPermission')-> name('admin.permission.createPermission');
//        Route::get('edit/{id}', 'Admin\PermissionController@edit')->name('admin.permission.edit')->middleware('can:permission-edit');
//        Route::delete('/{id}', 'Admin\PermissionController@destroy')->name('admin.permission.destroy')->middleware('can:permission-destroy');
//    });
    Route::group(['prefix' => 'roles','middleware' => 'role:root'],function (){
        Route::get('','Admin\RoleController@index')->name('admin.role.index')->middleware('can:role-list');
        Route::get('create','Admin\RoleController@create')->name('admin.role.create')->middleware('can:role-create');
        Route::post('create', 'Admin\RoleController@createRole')-> name('admin.role.createRole');
        Route::get('edit/{id}', 'Admin\RoleController@edit')->name('admin.role.edit')->middleware('can:role-edit');
        Route::delete('/{id}', 'Admin\RoleController@destroy')->name('admin.role.destroy')->middleware('can:role-destroy');

    });
    Route::group(['prefix' => 'articles'] ,function (){
        Route::get('', 'Admin\ArticleController@index')->name('admin.article.index')->middleware('can:article-list');
        Route::get('create','Admin\ArticleController@create')->name('admin.article.create')->middleware('can:article-create');
        Route::post('create', 'Admin\ArticleController@createArticle')->name('admin.article.createArticle');
        Route::get('edit/{id}', 'Admin\ArticleController@edit')->name('admin.article.edit')->middleware('can:article-edit');
        Route::delete('/{id}', 'Admin\ArticleController@destroy')->name('admin.article.destroy')->middleware('can:article-delete');
        Route::post('/reject/{id}','Admin\ArticleController@reject')->name('admin.article.reject')->middleware('can:article-reject');
        Route::post('/confirm/{id}','Admin\ArticleController@confirm')->name('admin.article.confirm')->middleware('can:article-confirm');
        Route::post('/publish/{id}','Admin\ArticleController@publish')->name('admin.article.publish')->middleware('can:article-publish');


    });
    Route::group(['prefix' => 'users','middleware' => 'role:root'],function (){
        Route::get('','Admin\UsersController@index')->name('admin.user.index')->middleware('can:user-list');
        Route::get('create','Admin\UsersController@create')->name('admin.user.create')->middleware('can:user-create');
        Route::post('create', 'Admin\UsersController@createUser')-> name('admin.user.createUser');
        Route::get('edit/{id}', 'Admin\UsersController@edit')->name('admin.user.edit')->middleware('can:user-edit');
        Route::delete('/{id}', 'Admin\UsersController@destroy')->name('admin.user.destroy')->middleware('can:user-destroy');
    });
    Route::prefix('send-mail')->group(function (){
        Route::get('','HomeController@sendMail')->name('admin.emails.email');

    });
});