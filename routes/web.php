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
    return redirect('/home');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('articles', 'ArticleController');

Route::any('autocomplete', 'ArticleController@autocomplete');

Route::resource('tags', 'TagController');

Route::resource('news', 'NewsController');

Route::resource('customers', 'CustomerController');

Route::resource('schedules', 'ScheduleController');