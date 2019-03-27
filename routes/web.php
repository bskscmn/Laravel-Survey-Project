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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/survey/{anketid}', function () {
    return view('surveyscroll');
})->name('surveyscroll');

Route::get('/survey/{anketid}',['as'=>'survey','uses'=>'AnswerController@index']);
Route::post('/survey/store/{anketid}',['as'=>'surveystore','uses'=>'AnswerController@store']);
Route::get('/survey/end/{anketid}', function () {
    return view('surveyend');
})->name('surveyend');


//Auth::routes();
Auth::routes(['register' => false, 'reset' => false]);


Route::group(['middleware' => 'auth'], function() {

  	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/profile',['as'=>'profile','uses'=>'UserController@profile']);
	Route::post('/profile/update',['as'=>'profileupdate','uses'=>'UserController@profileupdate']);

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

		//Questions
		Route::post('/questions/store/{anketid}',['as'=>'admin.questionstore','uses'=>'QuestionController@store']);
		Route::post('/questions/edit/{anketid}',['as'=>'admin.questionedit','uses'=>'QuestionController@update']);
		Route::delete('questions/delete/{id}', ['as' => 'admin.questiondestroy', 'uses' => 'QuestionController@destroy']);

		//Choices
		Route::post('/choices/store/{anketid}',['as'=>'admin.choicestore','uses'=>'ChoiceController@store']);
		Route::post('/choices/edit/{anketid}',['as'=>'admin.choiceedit','uses'=>'ChoiceController@update']);
		Route::delete('choices/delete/{id}', ['as' => 'admin.choicedestroy', 'uses' => 'ChoiceController@destroy']);

		//Scale
		Route::post('/scales/store/{anketid}',['as'=>'admin.createscalequestion','uses'=>'ChoiceController@storeScaleQuestion']);
		Route::delete('scales/delete/{id}', ['as' => 'admin.scalequestiondestroy', 'uses' => 'ChoiceController@destroyScaleQuestion']);


	});

	Route::group(['middleware' => 'roles', 'roles' => ['Analytics']], function() {

		//Ankets
		Route::get('/analytics',['as'=>'analytics.surveylist','uses'=>'AnalyticsController@index']);
		Route::get('/analytics/show/{id}',['as'=>'analytics.analytics','uses'=>'AnalyticsController@show']);
		Route::get('/analytics/other/{survey_id}/{id}',['as'=>'analytics.others','uses'=>'AnalyticsController@others']);
		Route::get('/analytics/open/{survey_id}/{id}',['as'=>'analytics.opens','uses'=>'AnalyticsController@opens']);

	});

});

