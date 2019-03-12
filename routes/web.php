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

		//Users
		Route::get('/users',['as'=>'admin.users','uses'=>'UserController@index']);
		Route::post('/newuser',['as'=>'admin.newuser','uses'=>'UserController@store']);
		Route::post('/edituser',['as'=>'admin.edituser','uses'=>'UserController@update']);
		Route::delete('user/delete/{id}', ['as' => 'admin.userdestroy', 'uses' => 'UserController@destroy']);

		//Ankets
		Route::get('/ankets',['as'=>'admin.ankets','uses'=>'AnketController@index']);
		Route::post('/ankets/store',['as'=>'admin.anketstore','uses'=>'AnketController@store']);
		Route::post('/ankets/edit',['as'=>'admin.anketedit','uses'=>'AnketController@update']);
		Route::delete('ankets/delete/{id}', ['as' => 'admin.anketdestroy', 'uses' => 'AnketController@destroy']);  	
		Route::get('/ankets/show/{id}',['as'=>'admin.anket','uses'=>'AnketController@show']);	

	});

});

