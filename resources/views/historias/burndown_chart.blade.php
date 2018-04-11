@extends('layouts/template_main')
@section('titulo_vista', 'Burndown Chart')

@section('contenedor_principal')
	<canvas id="burndown_chart" width="200px" height="200px"></canvas>

	<script src="{{ asset("js/historias.js") }}" charset="utf-8"></script>
	<script type="text/javascript">
		$("document").ready(function(){
			var estimacion = {!! $estimacion !!};
			var cantidad_historias = {!! $cantidad_historias !!};

			var historias = new Historias();
			historias.setUrl("{{ url("/") }}");
			historias.ev();
			historias.dibuja_grafica(estimacion, cantidad_historias);
		});
	</script>
@endsection
