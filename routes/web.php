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


Route::resource('books ', 'BooksController');
Route::resource('document ', 'DocumentController');


Route::post('audio/record','AudioController@save');
Route::post('audio/process','AudioController@processSpeech');

//Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/clear', function() {
    
    $exitCode = Artisan::call('config:cache');
});
