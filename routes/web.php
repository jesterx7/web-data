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
    return view('auth/login');
});
Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
	Route::get('{page}/add', ['as' => 'page.add', 'uses' => 'PageController@add']);
	Route::post('{page}', ['as' => 'page.save', 'uses' => 'PageController@save']);
	Route::post('{page}/import', ['as' => 'page.import', 'uses' => 'ImportController@import']);
});

/* API Routes */

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}/api/divisi/{id}', ['as' => 'api.divisi', 'uses' => 'ApiController@apiDivisi']);
	Route::get('{page}/api/leader/{id}', ['as' => 'api.leader', 'uses' => 'ApiController@apiLeader']);
});

