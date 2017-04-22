<?php

//Auth::routes();

Route::group(['middleware' => ['admin']], function () {
	
	Route::get('/', 'AdminController@dashboard')->name('admin');
	Route::resource('documents', 'DocumentController');
	Route::resource('documents/{id}/pages', 'PagesController');


});