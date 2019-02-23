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
    return redirect('/login');
});

Route::Auth();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@save')->name('save');

Route::get('/demos/jquery-image-upload','DemoController@showJqueryImageUpload');
Route::post('/demos/jquery-image-upload','DemoController@saveJqueryImageUpload');
