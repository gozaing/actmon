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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


Route::get('/posts', 'PostController@index');
Route::post('/post', 'PostController@store');
Route::get('/confirm', 'PostController@confirm');
Route::post('/complete', 'PostController@complete');
Route::get('/edit/{id}', 'PostController@edit');
Route::post('/update/{id}', 'PostController@update');
Route::delete('/post/{post}', 'PostController@destroy');