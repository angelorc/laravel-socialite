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

Route::auth();
/*Route::get('/login', 'Auth\AuthController@login');
Route::get('/logout', 'Auth\AuthController@logout');*/
Route::get('/', 'HomeController@index');

Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');


Route::post('/upload', 'HomeController@upload');