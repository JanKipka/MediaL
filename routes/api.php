<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('auth')->group(function () {
    Route::post('signin', 'SignInController');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});
Route::post('ext/query/books', 'ApiController@books');
Route::post('ext/query/movies', 'ApiController@movies');

Route::prefix('media')->group(function () {
    Route::get('/all', 'MediaController@all');
    Route::post('/add/book', 'MediaController@addBook');
    Route::get('/meta/all', 'MetaController@all');
    Route::get('/meta/authors', 'MetaController@authors');
    Route::get('/meta/directors', 'MetaController@directors');
});
