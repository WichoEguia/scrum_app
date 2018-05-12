@extends('layouts/template_main')
@section('titulo_vista', 'Burndown Chart')

@section('accion_navegacion_lateral')
	<a href="{{ route("nueva_historia") }}">
		<i class="fas fa-plus"></i>
		Nueva Historia
	</a>
@endsection

@section('contenedor_principal')
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	<link rel="stylesheet" href="{{ asset("css/highcharts.css") }}">
	<script src="{{ asset("js/highcharts.js") }}" charset="utf-8"></script>
	<script src="{{ asset("js/historias.js") }}" charset="utf-8"></script>
	<script type="text/javascript">
		$("document").ready(function(){
			var puntos_esfuerzo_total = {!! $puntos_esfuerzo_total !!};
			var puntos_esfuerzo = {!! $puntos_esfuerzo !!};
			var fechas = {!! $fechas !!};
			// console.log(puntos_esfuerzo_total);
			for (var i = 0; i < puntos_esfuerzo.length; i++) {
				puntos_esfuerzo[i] = puntos_esfuerzo_total - puntos_esfuerzo[i];
			}
			console.log(puntos_esfuerzo);

			var historias = new Historias();
			historias.setUrl("{{ url("/") }}");
			historias.ev();
			historias.dibuja_grafica(puntos_esfuerzo_total, puntos_esfuerzo,fechas);
		});
	</script>
@endsection
