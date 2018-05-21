@extends('layouts/template_main')
@section('titulo_vista', 'Burndown Chart')

@if($proyecto->es_scrum_master())
	@section('accion_navegacion_lateral')
		<a href='/fin_sprint/{{ $sprint_actual->id }}' onclick="event.preventDefault(); document.getElementById('form_fin_sprint').submit();">
			<i class="far fa-check-circle"></i>
			Fin Sprint
		</a>
	@endsection
@endif

@section('contenedor_principal')

	<br>
	@if (count((array)$sprints) > 0)
		<a href="#modal_lista_sprints" rel="modal:open" style="margin-left: 20px;" class="boton accion_modal">
			<i class="fas fa-list-alt"></i>
			Historial Sprints
		</a>
	@endif
	<br><br><br>

	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<br><br><br>

	<div id="modal_lista_sprints" class="modal">
		<p class="titulo_vista">Sprints</p>
		@foreach ($sprints as $sprint)
			<a href="/sprint/{{ $sprint->id }}" class="tarjeta_sprint">
				<p>Sprint {{ $sprint->id }}</p>
				<p>{{ "De " . substr($sprint->created_at, 0, 10) . " a " . substr($sprint->updated_at, 0, 10) }}</p>
			</a>
		@endforeach
	</div>

	<form id="form_fin_sprint" action="/fin_sprint" method="post" style="display: none;">
		{{ csrf_field() }}
		<input type="text" name="sprint" value="{{ $sprint_actual->id }}">
		<input type="text" name="arr_puntos" id="arr_puntos" value="">
		<input type="text" name="arr_fechas" id="arr_fechas" value="">
	</form>

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
