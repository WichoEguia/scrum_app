<?php
Route::get('/', "HistoriaController@index")->name('raiz');
Route::get('/historia/nueva', 'HistoriaController@create')->name('nueva_historia');
Route::post('/historias', 'HistoriaController@store');
