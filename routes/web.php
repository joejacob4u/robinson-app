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

//Route::post('/record','AudioController@save');




Auth::routes();
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::resource('accounts', 'AccountsController');
Route::get('accounts/user-type/{user}', 'AccountsController@userType');


Route::resource('read/documents', 'ReadController');

Route::get('/read', function () {
    return redirect('/read/documents');
});



Route::resource('read/documents', 'ReadController');
Route::resource('read/document-{id}/pages', 'ReadPagesController');
Route::post('read/document/save-state','ReadPagesController@saveUserState');

Route::post('/record','WRTCController@save');

Route::get('/read-status/{user}/{did}/{id}','ReadPagesController@readStatus');

Route::get('/teacher','TeacherController@index');
Route::get('/parent','TeacherController@index');

Route::post('/get_result', 'ResultsController@getResults');

Route::get('/get-user-state', 'ReadController@userState');