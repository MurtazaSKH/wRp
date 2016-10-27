<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'UserController@getLogin');
Route::get('login','UserController@getLogin');
Route::get('signup', 'UserController@getSignUp');
Route::post('postSignup', 'UserController@postSignup');
Route::post('postLogin', 'UserController@postLogin');

Route::group(['middleware' => 'auth'], function(){
   Route::get('account', 'AccountController@index');
   Route::get('logout', 'AccountController@logout');
   Route::get('users', 'UserController@load');
   // Routes for Categories
   Route::get('categories', 'CategoryController@load');
   Route::get('categories/{id}', 'CategoryController@load');
   Route::post('createcategory', 'CategoryController@proc');
   Route::post('editcategory/{id}', 'CategoryController@proc');
   Route::get('deletecategory/{id}', 'CategoryController@delete');
   // Routes for Questions
   Route::get('questions', 'QuestionController@load');
   Route::get('questions/{id}', 'QuestionController@load');
   Route::post('createquestion', 'QuestionController@proc');
   Route::post('editquestion', 'QuestionController@editQuestion');
   Route::get('deletequestion/{id}', 'QuestionController@delete');
   //For Api
   Route::get('api/categories', 'CategoryController@apiload');
   Route::post('api/questions', 'QuestionController@apiload');
   Route::post('api/postscore', 'UserController@postscore');
});

