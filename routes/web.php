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
Route::get('/survey/{surveyid}',['as'=>'survey','uses'=>'AnswerController@index']);
Route::post('/survey/store/{surveyid}',['as'=>'surveystore','uses'=>'AnswerController@store']);
Route::get('/survey/end/{surveyid}', function () {
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
		Route::get('/surveys',['as'=>'admin.surveys','uses'=>'SurveyController@index']);
		Route::post('/surveys/store',['as'=>'admin.surveystore','uses'=>'SurveyController@store']);
		Route::post('/surveys/edit',['as'=>'admin.surveyedit','uses'=>'SurveyController@update']);
		Route::delete('surveys/delete/{id}', ['as' => 'admin.surveydestroy', 'uses' => 'SurveyController@destroy']);
		Route::get('/surveys/show/{id}',['as'=>'admin.survey','uses'=>'SurveyController@show']);

		//Questions
		Route::post('/questions/store/{surveyid}',['as'=>'admin.questionstore','uses'=>'QuestionController@store']);
		Route::post('/questions/edit/{surveyid}',['as'=>'admin.questionedit','uses'=>'QuestionController@update']);
		Route::delete('questions/delete/{id}', ['as' => 'admin.questiondestroy', 'uses' => 'QuestionController@destroy']);

		//Choices
		Route::post('/choices/store/{surveyid}',['as'=>'admin.choicestore','uses'=>'ChoiceController@store']);
		Route::post('/choices/edit/{surveyid}',['as'=>'admin.choiceedit','uses'=>'ChoiceController@update']);
		Route::delete('choices/delete/{id}', ['as' => 'admin.choicedestroy', 'uses' => 'ChoiceController@destroy']);

		//Scale
		Route::post('/scales/store/{surveyid}',['as'=>'admin.createscalequestion','uses'=>'ChoiceController@storeScaleQuestion']);
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

