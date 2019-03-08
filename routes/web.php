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

