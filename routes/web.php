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

Route::get('location/show2/{id}', 'LocationController@show');
// Route::resource('location.show', 'LocationController@show');
Route::resource('location', 'LocationController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
