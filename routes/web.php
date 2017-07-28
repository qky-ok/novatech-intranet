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

Route::group(['middleware' => 'web'], function () {
    Route::get('/', ['as' => 'intranet', 'uses' => 'HomeController@index']);
    Route::get('/services/search/{search}', ['as' => 'services.search', 'uses' => 'ServiceController@search']);
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    /*Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('states', 'StateController');
    Route::resource('services', 'ServiceController');*/
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@home']);

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', ['as' => 'users.index', 'uses' => 'UserController@index']);
        Route::get('/show', ['as' => 'users.show', 'uses' => 'UserController@show']);
        Route::get('/create/{role_id?}', ['as' => 'users.create', 'uses' => 'UserController@create']);
        Route::post('/store', ['as' => 'users.store', 'uses' => 'UserController@store']);
        Route::get('/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
        Route::put('/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
        Route::delete('/destroy', ['as' => 'users.destroy', 'uses' => 'UserController@destroy']);
    });

    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', ['as' => 'roles.index', 'uses' => 'RoleController@index']);
        Route::get('/show', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
        Route::get('/create', ['as' => 'roles.create', 'uses' => 'RoleController@create']);
        Route::post('/store', ['as' => 'roles.store', 'uses' => 'RoleController@store']);
        Route::get('/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit']);
        Route::post('/update', ['as' => 'roles.update', 'uses' => 'RoleController@update']);
        Route::delete('/destroy', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy']);
    });

    Route::group(['prefix' => 'states'], function() {
        Route::get('/', ['as' => 'states.index', 'uses' => 'StateController@index']);
        Route::get('/show', ['as' => 'states.show', 'uses' => 'StateController@show']);
        Route::get('/create', ['as' => 'states.create', 'uses' => 'StateController@create']);
        Route::post('/store', ['as' => 'states.store', 'uses' => 'StateController@store']);
        Route::get('/edit', ['as' => 'states.edit', 'uses' => 'StateController@edit']);
        Route::put('/update', ['as' => 'states.update', 'uses' => 'StateController@update']);
        Route::delete('/destroy', ['as' => 'states.destroy', 'uses' => 'StateController@destroy']);
    });

    Route::group(['prefix' => 'services'], function() {
        Route::get('/', ['as' => 'services.index', 'uses' => 'ServiceController@index']);
        Route::get('/show', ['as' => 'services.show', 'uses' => 'ServiceController@show']);
        Route::get('/create', ['as' => 'services.create', 'uses' => 'ServiceController@create']);
        Route::post('/store', ['as' => 'services.store', 'uses' => 'ServiceController@store']);
        Route::get('/edit', ['as' => 'services.edit', 'uses' => 'ServiceController@edit']);
        Route::put('/update', ['as' => 'services.update', 'uses' => 'ServiceController@update']);
        Route::post('/history', ['as' => 'services.history', 'uses' => 'ServiceController@getHistory']);
        Route::delete('/destroy', ['as' => 'services.destroy', 'uses' => 'ServiceController@destroy']);
    });
});
