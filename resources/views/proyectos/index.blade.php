@extends('layouts/template_main')
@section('titulo_vista', 'Proyectos')

@section('contenedor_principal')
	<div class="cabecera_proyectos flex centerY">
		<p>Selecciona un proyecto.</p>
		<a class="boton" href="{{ route("nuevo_proyecto") }}">
			<div class="boton_icono">
				<i class="fas fa-plus"></i>
				Nuevo Proyecto
			</div>
		</a>
	</div>
	<div class="proyectos_contenedor_xd">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		@if (count($proyectos) > 0)
			@include('./proyectos/_modales')

			@foreach ($proyectos as $proyecto)
				<div class="tarjeta_proyecto flex">
					<input type="hidden" class="id_proyecto" value="{{ $proyecto->id }}">
					<div class="">
						<img class="foto_proyecto" src="{{ asset('img/perfil_foto_prueba.jpg') }}" alt="">
					</div>
					<div class="datos_proyecto flex">
						<div class="datos_proyecto_inner">
							<p class="titulo_proyecto">{{ $proyecto->nombre }}</p>
							<p class="descripcion_proyecto">{{ $proyecto->descripcion }}</p>
						</div>
						<div class="flex" style="justify-content: space-between;">
							<p class="no_integrantes_proyecto">1 integrante</p>

							@if ($proyecto->es_scrum_master())
								<div class="acciones_proyecto">
									<a href="#modal_invitar_integrante" rel="modal:open" class="accion_modal accion modal_agregar_nuevo_integrante_proyecto">
										<i class="agregar_nuevo_integrante_proyecto fas fa-user-plus"></i>
									</a>
									<a href="#" class="accion boton_editar_proyecto">
										<i class="editar_proyecto fas fa-pencil-alt"></i>
									</a>
									<a href="#modal_eliminar_proyecto" rel="modal:open" class="accion_modal accion modal_eliminar_proyecto">
										<i class="eliminar_proyecto far fa-trash-alt"></i>
									</a>
								</div>
							@endif
						</div>
					</div>
				</div>
			@endforeach
		@else
			<p class="no_historias_msg">No hay proyectos</p>
		@endif
	</div>

	<script src="{{ asset("js/proyectos.js") }}" charset="utf-8"></script>
	<script type="text/javascript">
		$("document").ready(function(){
			var proyectos = new Proyectos();
			proyectos.setUrl("{{ url("/") }}");
			proyectos.ev();
		});
	</script>
@endsection
