@extends('layouts.template_main')

@section('titulo_vista', 'Inicio')

@section('contenedor_principal')
	<div class="scrum_board">
		<div class="columna_scrum_board" id="backlog_list">
			<p class="titulo_columna-scrum">Backlog List</p>
		</div>
		<div class="columna_scrum_board" id="por_hacer">
			<p class="titulo_columna-scrum">Por Hacer</p>
		</div>
		<div class="columna_scrum_board" id="iniciado">
			<p class="titulo_columna-scrum">Haciendo</p>
		</div>
		<div class="columna_scrum_board" id="terminado">
			<p class="titulo_columna-scrum">Terminado</p>
		</div>
	</div>

	<script src="{{ asset('js/scrum_board.js') }}" charset="utf-8"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var historias = {!! $historias !!};

			var scrumBoard = new Board();
			scrumBoard.setUrl("{{ url('/') }}");
			scrumBoard.ev();
			scrumBoard.generar_historias(historias);
		});
	</script>
@endsection
