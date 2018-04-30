@extends('layouts/template_main')
@section('titulo_vista', 'Nuevo Proyecto')

@section('contenedor_principal')
	<form class="formulario_crear_proyectos" action="{{ route('guardar_proyecto') }}" method="post">
		@include('./proyectos/_form')

		<div class="field">
			<input type="submit" name="" value="Enviar">
		</div>
	</form>

	<script src="{{ asset("js/proyectos.js") }}" charset="utf-8"></script>
	<script type="text/javascript">
		$("document").ready(function(){
			var proyectos = new Proyectos();
			proyectos.setUrl("{{ url("/") }}");
			proyectos.ev();
		});
	</script>
@endsection
