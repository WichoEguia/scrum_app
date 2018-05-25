@extends('layouts/template_main')
@section('titulo_vista', 'tareas realizadas el día ' . $fecha)
@section('accion_navegacion_lateral')
	<a href='/sprint/{{ $sprint }}'>
		<i class="far fa-check-circle"></i>
		Volver a resumen de sprint
	</a>
@endsection

@section('contenedor_principal')
	<div id="contenedor_historias_sprint">
		<div id="contenedor_historias">
			@foreach ($historias as $historia)
				<div class='flex tarjeta_historia' id={{ $historia->id }}>
					<div>
						<div class='idhistoria flex'>
							<div class='flex centerX centerY'>
								<p>{{ $historia->id }}</p>
							</div>
						</div>
						<p class='historia_titulo'>{{ $historia->titulo }}</p>
						<div class='historia_descripcion'>
							<p>{{ $historia->descripcion }}</p>
						</div>
					</div>
					<div class='acciones_historia'>
						<div class='flex'>
							<p class='importancia'>{{ $historia->importancia }}</p>
							<p class='estimacion'>{{ $historia->estimacion > 0.5 ? $historia->estimacion : '1/2' }}</p>
						</div>
						<p class="fechas_avance">Inicio el {{ substr($historia->created_at, 0, 10) }}</p>
						<p class="fechas_avance">Terminado el {{ substr($historia->updated_at, 0, 10) }}</p>
					</div>
				</div>
			@endforeach
		</div>
	</div>

	{{-- <link rel="stylesheet" href="{{ asset("css/highcharts.css") }}">
	<script src="{{ asset("js/highcharts.js") }}" charset="utf-8"></script>
	<script src="{{ asset("js/historias.js") }}" charset="utf-8"></script>
	<script type="text/javascript">
		$("document").ready(function(){
			var puntos_esfuerzo_total = {!! $sprint->puntos_esfuerzo !!};
			var fechas = "{!! $sprint->arr_fechas !!}".split(',');
			var puntos_esfuerzo_res = "{!! $sprint->arr_puntos !!}".split(',');

			var historias = new Historias();
			historias.setUrl("{{ url("/") }}");
			historias.ev();
			historias.dibuja_grafica(puntos_esfuerzo_total, puntos_esfuerzo_res, fechas);
		});
	</script> --}}
@endsection
