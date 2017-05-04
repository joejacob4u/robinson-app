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

Route::get('/test','AudioController@index');

Route::post('/process','AudioController@processSpeech');

Route::post('/record','AudioController@save');


 

Auth::routes();
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::resource('accounts', 'AccountsController');

Route::get('accounts/user-type/{user}', 'AccountsController@userType');






 
 
 

