@extends('layouts/template_main')
@section('titulo_vista', 'Burndown Chart')

@section('contenedor_principal')
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	<link rel="stylesheet" href="{{ asset("css/highcharts.css") }}">
	<script src="{{ asset("js/highcharts.js") }}" charset="utf-8"></script>
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
