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
	if (Auth::check()) {
		return redirect()->route('page.index', 'dashboard');
	}
    return view('auth/login');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
	Route::get('{page}/add', ['as' => 'page.add', 'uses' => 'PageController@add']);
	Route::get('{page}/search', ['as' => 'page.search', 'uses' => 'PageController@search']);
	Route::get('{page}/export/{type}', ['as' => 'page.export', 'uses' => 'ImportController@export']);
	Route::get('{page}/{id}', ['as' => 'page.edit', 'uses' => 'PageController@edit']);
	Route::get('admin/{page}/add', ['as' => 'admin.add', 'uses' => 'AdminController@add']);
	Route::post('admin/{page}', ['as' => 'admin.save', 'uses' => 'AdminController@save']);
	Route::post('{page}', ['as' => 'page.save', 'uses' => 'PageController@save']);
	Route::post('{page}/import', ['as' => 'page.import', 'uses' => 'ImportController@import']);
});

/* API Routes */

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}/api/{id}/{e_id}', ['as' => 'api.ajax', 'uses' => 'ApiController@apiAjax']);
	Route::post('{page}/api/tutupbuka/{id}', ['as' => 'api.tutupbuka', 'uses' => 'ApiController@apiTutupBuka']);
	Route::delete('{page}/api/{id}', ['as' => 'api.delete', 'uses' => 'ApiController@apiDelete']);
	Route::put('{page}/api/{id}', ['as' => 'api.edit', 'uses' => 'ApiController@apiEdit']);
});

