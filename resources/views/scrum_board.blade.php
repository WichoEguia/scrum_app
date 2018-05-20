@extends('layouts.template_main')
@section('titulo_vista', 'Scrum Board')

@section('accion_navegacion_lateral')
	<a href="{{ route("nueva_historia") }}">
		<i class="fas fa-plus"></i>
		Nueva Historia
	</a>
@endsection

@section('contenedor_principal')

	<div class="boton_accion">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	</div>

	<div class="scrum_board">
		<div class="columna_scrum_board" id="to_do">
			<p class="titulo_columna-scrum">To Do</p>
		</div>
		<div class="columna_scrum_board" id="doing">
			<p class="titulo_columna-scrum">Doing</p>
		</div>
		<div class="columna_scrum_board" id="testing">
			<p class="titulo_columna-scrum">Testing</p>
		</div>
		<div class="columna_scrum_board" id="done">
			<p class="titulo_columna-scrum">Done</p>
		</div>
	</div>

	<script src="{{ asset('js/scrum_board.js') }}" charset="utf-8"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var historias = {!! $historias !!};
			var proyectos = {!! $proyectos !!};
			var proyecto_id = {!! $proyecto_id !!};
			var scrum_master = {!! $scrum_master !!}

			var scrumBoard = new Board();
			scrumBoard.setUrl("{{ url('/') }}");
			scrumBoard.ev();
			scrumBoard.generar_historias(historias, scrum_master);
			scrumBoard.validaciones_proyectos(proyectos, proyecto_id);
		});
	</script>
@endsection
