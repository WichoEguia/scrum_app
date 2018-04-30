@extends('layouts/template_main')
@section('titulo_vista', 'Editar Historia')

@section('contenedor_principal')
	<form class="formulario_historias" action="/historia/{{ $historia->id }}" method="post">
		{{ method_field('PATCH') }}
		@include('./historias/_form')

		<div class="field">
			<input type="submit" name="" value="Enviar">
		</div>
	</form>

	<script src="{{ asset("js/historias.js") }}" charset="utf-8"></script>
	<script type="text/javascript">
		$("document").ready(function(){
			var historias = new Historias();
			historias.setUrl("{{ url("/") }}");
			historias.ev();
		});
	</script>
@endsection
