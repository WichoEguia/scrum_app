@extends('layouts/template_main')
@section('titulo_vista', 'Nueva Historia')

@section('contenedor_principal')
	<form class="formulario_historias" action="index.html" method="post">
		@include('./historias/_form')

		<div class="field">
			<input type="submit" name="" value="Enviar">
		</div>
	</form>
@endsection