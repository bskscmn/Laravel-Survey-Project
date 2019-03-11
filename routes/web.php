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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile',['as'=>'profile','uses'=>'UserController@profile']);

Route::get('/users',['as'=>'admin.users','uses'=>'UserController@index','middleware' => ['roles'], 'roles' => ['Admin']]);
Route::post('/newuser',['as'=>'admin.newuser','uses'=>'UserController@store','middleware' => ['roles'], 'roles' => ['Admin']]);
Route::post('/edituser',['as'=>'admin.edituser','uses'=>'UserController@update','middleware' => ['roles'], 'roles' => ['Admin']]);
Route::delete('user/{id}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);

Route::get('/ankets',['as'=>'admin.ankets','uses'=>'AnketController@index','middleware' => ['roles'], 'roles' => ['Admin']]);
Route::post('/newanket',['as'=>'admin.newanket','uses'=>'AnketController@store','middleware' => ['roles'], 'roles' => ['Admin']]);