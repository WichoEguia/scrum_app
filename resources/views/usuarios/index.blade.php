@extends('layouts/template_main')
@section('titulo_vista', 'Perfil')

@section('contenedor_principal')
	<div id="contenedor_foto_nombre" class="flex">
		<img src="{{ asset(Auth::User()->userphoto) }}" alt="">
		<div id="nombre_usuario">
			<p>{{ $usuario->name }}</p>
			<p>{{ $usuario->email }}</p>
			<a href="{{ route('editar_perfil', ['user' => Auth::User()]) }}">Editar Perfil</a>
		</div>
	</div>


	<div id="contenedor_proyectos_perfil">
		@if (count($proyectos) > 0)
			<p class="titulo_proyectos_perfil">Proyectos</p>
			@for ($i=0; $i < count($proyectos); $i++)
				<div class="contenedor_proyecto_perfil">
					@if ($proyectos[$i]->es_scrum_master())
						<div class="flex">
							<i class="fas fa-star icono_scrum_master"></i>
						</div>
					@endif

					<p class="nombre_proyecto_perfil">{{ $proyectos[$i]->nombre }}</p>
					<p>{{ $proyectos[$i]->descripcion }}</p>
				</div>
			@endfor
		@else
			<p class="titulo_proyectos_perfil">Sin proyectos</p>
		@endif
	</div>
@endsection
