<?php

//Auth::routes();

Route::group(['middleware' => ['admin']], function () {

	Route::get('/', 'AdminController@dashboard')->name('admin');
	Route::resource('documents', 'DocumentController');
	Route::resource('documents/{id}/pages', 'PagesController');

	Route::get('/', 'AdminController@dashboard')->name('admin');

	Route::get('results', 'ResultsController@index')->name('results');
	Route::post('results/get_result', 'ResultsController@getResults');
	Route::get('results/process/document', 'ResultsController@documentCron');

});
