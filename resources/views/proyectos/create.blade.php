@extends('layouts/template_main')
@section('titulo_vista', 'Nuevo Proyecto')

@section('contenedor_principal')
	<form class="formulario_proyectos" action="{{ route('guardar_proyecto') }}" method="post">
		@include('./proyectos/_form')

		<div class="field">
			<input type="submit" name="" value="Enviar">
		</div>
	</form>
@endsection
