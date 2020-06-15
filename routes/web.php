<?php

use Illuminate\Support\Facades\Route;

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
// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', function (){
    return view('spa');
})->where('any', '^(?!api\/)[\/\w\.-]*');
/*Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add', 'HomeController@add')->name('add');
Route::post('/persist', 'AddController@persist')->name('persist');
Route::get('/list', 'ListController@list')->name('list');
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::post('/updateProfile', 'ProfileController@update')->name('updateProfile');*/
