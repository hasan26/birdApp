<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/home', 'HomeAPIController@index');
Route::get('/tag', 'HomeAPIController@getAllTag');
Route::get('tag/{id}', [
    'uses' => 'HomeAPIController@getAllArticlesByTag'
]);
Route::get('/articles', 'HomeAPIController@getAllArticles');
Route::get('articles/{id}', [
    'uses' => 'HomeAPIController@getArticle'
]);
Route::get('/news', 'HomeAPIController@getAllnews');

Route::post('/register', 'HomeAPIController@registerUser');
Route::post('/login', 'HomeAPIController@login');

Route::group(['middleware' => 'jwt-auth'], function () {
    Route::post('/scedule', 'HomeAPIController@makeScedule');
});