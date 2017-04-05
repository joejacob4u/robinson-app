<?php

Auth::routes();

Route::group(['middleware' => ['admin']], function () {
	
	Route::get('/', 'AdminController@dashboard');
	Route::resource('document', 'DocumentController');
	Route::get('document/delete/{id}', 'DocumentController@destroy');

	Route::resource('pages', 'PagesController');
	Route::get('pages/list/{id}', 'PagesController@index');
	Route::get('pages/add/{id}', 'PagesController@create');
	Route::get('pages/edit/{did}/{pid}', 'PagesController@edit');
	Route::get('pages/delete/{did}/{id}', 'PagesController@destroy');
});