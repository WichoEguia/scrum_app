@extends('layouts/template_main')
@section('titulo_vista', 'Proyectos')

@section('contenedor_principal')
	@foreach ($proyectos as $proyecto)
		<p>{{ $proyecto->nombre }}</p>
	@endforeach
@endsection
