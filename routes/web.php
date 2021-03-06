<?php
Auth::routes();

Route::group(['middleware' => ['auth']], function() {
	Route::get('/', function(){
		return redirect('/proyectos');
	});

	Route::get('/proyectos', 'ProyectoController@index')->name('ruta_proyectos');
	Route::get('/proyecto/nuevo', 'ProyectoController@create')->name('nuevo_proyecto');
	Route::post('/proyectos', 'ProyectoController@store')->name('guardar_proyecto');
	Route::get('/proyecto/{proyecto}/editar', 'ProyectoController@edit');
	Route::patch('/proyecto/{proyecto}', 'ProyectoController@update');
	Route::delete('/proyecto/{proyecto}', 'ProyectoController@destroy');
	Route::post('/asociar_proyecto_usuario', 'ProyectoController@asociar_proyecto_usuario');
	Route::post('/invitar_usuario_proyecto', 'ProyectoController@invitar_usuario_proyecto');

	Route::get('/scrumboard', "HistoriaController@index")->name('scrum_board');
	Route::get('/historia/nuevo', 'HistoriaController@create')->name('nueva_historia');
	Route::post('/historias', 'HistoriaController@store');
	Route::get('/historia/{historia}/editar', 'HistoriaController@edit');
	Route::patch('/historia/{historia}', 'HistoriaController@update');
	Route::post('/actualiza_historia', 'HistoriaController@actualiza_estatus_tarea');
	Route::get('/burndown_chart', 'HistoriaController@burndown_chart')->name('burndown_chart');
	Route::get('/historia/{historia}/eliminar', 'HistoriaController@baja_historia');
	Route::get('/historia_terminadas_fecha/{sprint}/{fecha}', 'HistoriaController@historia_terminadas_fecha');

	Route::get('/perfil', 'UserController@index')->name('perfil');
	Route::get('/perfil/edit/{user}', 'UserController@edit')->name('editar_perfil');
	Route::patch('/user/{user}', 'UserController@update');

	Route::post('/actualizar_notificacion', 'MainController@actualizar_notificacion');
	Route::post('/fin_sprint', 'MainController@fin_sprint');
	Route::get('/sprint/{sprint}', 'MainController@ver_sprint');
});
