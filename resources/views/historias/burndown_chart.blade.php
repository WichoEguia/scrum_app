@extends('layouts/template_main')
@section('titulo_vista', 'Burndown Chart')

@if($proyecto->es_scrum_master())
	@section('accion_navegacion_lateral')
		<a href='/fin_sprint/{{ $sprint_actual->id }}'>
			<i class="far fa-check-circle"></i>
			Fin Sprint
		</a>
	@endsection
@endif

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
			var puntos_esfuerzo_res = [];

			for (var j = 0; j < puntos_esfuerzo.length; j++) {
				puntos_esfuerzo_res.push(puntos_esfuerzo_total)
				for (var i = 0; i < j + 1; i++) {
					puntos_esfuerzo_res[j] -= puntos_esfuerzo[i];
				}
			}

			var historias = new Historias();
			historias.setUrl("{{ url("/") }}");
			historias.ev();
			historias.dibuja_grafica(puntos_esfuerzo_total, puntos_esfuerzo_res, fechas);
		});
	</script>
@endsection
