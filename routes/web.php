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

//Auth::routes();
Auth::routes(['register' => false]);


Route::group(['middleware' => 'auth'], function() {

  	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/profile',['as'=>'profile','uses'=>'UserController@profile']);

	Route::group(['middleware' => 'roles', 'roles' => ['Admin']], function() {

		Route::get('/users',['as'=>'admin.users','uses'=>'UserController@index']);
		Route::post('/newuser',['as'=>'admin.newuser','uses'=>'UserController@store']);
		Route::post('/edituser',['as'=>'admin.edituser','uses'=>'UserController@update']);
		Route::delete('user/{id}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);

  		Route::resource('ankets', 'AnketController');

	});

});

