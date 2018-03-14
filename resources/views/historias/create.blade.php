@extends('layouts/template_main')
@section('titulo_vista', 'Nueva Historia')

@section('contenedor_principal')
	<p class="titulo_fomulario_historia">Nueva Historia</p>

	<form class="formulario_historias" action="/historias" method="post">
		@include('./historias/_form')

		<div class="field">
			<input type="submit" name="" value="Enviar">
		</div>
	</form>
@endsection
