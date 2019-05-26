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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post','PostController@post')->middleware('auth');

Route::get('/profile','ProfileController@profile')->middleware('auth');

Route::get('/category','CategoryController@category')->middleware('auth');

Route::post('/addcategory','CategoryController@addcategory')->middleware('auth');

Route::post('/addpost','PostController@addpost')->middleware('auth');

Route::get('/view/{id}','PostController@view')->middleware('auth');

Route::get('/edit/{id}','PostController@edit')->middleware('auth');

Route::post('/editpost/{id}','PostController@editpost')->middleware('auth');

Route::get('/delete/{id}','PostController@deletepost')->middleware('auth');

Route::get('/category/{id}','PostController@category')->middleware('auth');

Route::get('/like/{id}','PostController@like')->middleware('auth');

Route::get('/dislike/{id}','PostController@dislike')->middleware('auth');

Route::post('/comment/{id}','PostController@comment')->middleware('auth');

Route::post('/search','PostController@search')->middleware('auth');

