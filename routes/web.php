<?php
Auth::routes();

Route::group(['middleware' => ['auth']], function() {
	Route::get('/', function(){
		return redirect('/proyectos');
	});
	Route::get('/scrumboard', "HistoriaController@index")->name('scrum_board');
	Route::get('/historia/nuevo', 'HistoriaController@create')->name('nueva_historia');
	Route::post('/historias', 'HistoriaController@store');
	Route::post('/actualiza_historia', 'HistoriaController@actualiza_estatus_tarea');
	Route::get('/proyectos', 'ProyectoController@index')->name('ruta_proyectos');
	Route::get('/proyecto/nuevo', 'ProyectoController@create')->name('nuevo_proyecto');
	Route::post('/proyectos', 'ProyectoController@store')->name('guardar_proyecto');
	Route::post('/asociar_proyecto_usuario', 'ProyectoController@asociar_proyecto_usuario');
	Route::get('/burndown_chart', 'HistoriaController@burndown_chart')->name('burndown_chart');
});
