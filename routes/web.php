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
	Route::get('/burndown_chart', 'HistoriaController@burndown_chart')->name('burndown_chart');

	Route::get('/proyectos', 'ProyectoController@index')->name('ruta_proyectos');
	Route::get('/proyecto/nuevo', 'ProyectoController@create')->name('nuevo_proyecto');
	Route::post('/proyectos', 'ProyectoController@store')->name('guardar_proyecto');
	Route::get('/proyecto/{proyecto}/editar', 'ProyectoController@edit');
	Route::patch('/proyecto/{proyecto}', 'ProyectoController@update');
	Route::post('/asociar_proyecto_usuario', 'ProyectoController@asociar_proyecto_usuario');
	Route::post('/invitar_usuario_proyecto', 'ProyectoController@invitar_usuario_proyecto');

	Route::post('/actualizar_notificacion', 'MainController@actualizar_notificacion');
});
