<?php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/', "HistoriaController@index")->name('raiz');
	Route::get('/historia/nueva', 'HistoriaController@create')->name('nueva_historia');
	Route::post('/historias', 'HistoriaController@store');
	Route::post('/actualiza_historia', 'HistoriaController@actualiza_estatus_tarea');
});
