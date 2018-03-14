@extends('layouts.template_main')

@section('titulo_vista', 'Inicio')

@section('contenedor_principal')
	<div class="scrum_board">
		<div class="columna_scrum_board">
			<p class="titulo_columna-scrum">Backlog List</p>
		</div>
		<div class="columna_scrum_board">
			<p class="titulo_columna-scrum">Por Hacer</p>
		</div>
		<div class="columna_scrum_board">
			<p class="titulo_columna-scrum">Haciendo</p>
		</div>
		<div class="columna_scrum_board">
			<p class="titulo_columna-scrum">Terminado</p>
		</div>
	</div>

	<script type="text/javascript">
		var historias = {!! $historias !!};
		console.log(historias);
	</script>
@endsection
