@extends('layouts/template_main')
@section('titulo_vista', 'Proyectos')

@section('accion_navegacion_lateral')
	<a href="{{ route("nuevo_proyecto") }}">
		<i class="fas fa-plus"></i>
		Nuevo Proyecto
	</a>
@endsection

@section('contenedor_principal')
	<div class="cabecera_proyectos flex centerY">
		<p>Selecciona un proyecto.</p>
	</div>
	<div class="proyectos_contenedor_xd">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		@if (count($proyectos) > 0)
			@include('./proyectos/_modales')

			@foreach ($proyectos as $proyecto)
				<div class="tarjeta_proyecto flex">
					<input type="hidden" class="id_proyecto" value="{{ $proyecto->id }}">
					<div class="datos_proyecto flex">
						<div class="datos_proyecto_inner">
							<p class="titulo_proyecto">{{ $proyecto->nombre }}</p>
							<p class="descripcion_proyecto">{{ $proyecto->descripcion }}</p>
						</div>
						<div class="flex" style="justify-content: space-between;">
							<a href="#modal_listado_integrantes" rel="modal:open" class="accion_modal no_integrantes_proyecto">
								{{ count($proyecto->users) }} Integrante{{ count($proyecto->users)  > 1 ? 's' : '' }}
							</a>

							{{-- <div id="modal_listado_integrantes" class="modal">
								<p class="titulo_vista">Integrantes</p>
								<ul>
									@foreach ($proyecto->users as $user)
										<li class="flex">
											<div>
												<p>{{ $user->name }}</p>
												<p>{{ $user->email }}</p>
											</div>

											<div class="flex centerY">
												@if ($proyecto->scrum_master == $user->id)
													<p><i class="far fa-star"></i></p>
												@endif
											</div>
										</li>
									@endforeach
								</ul>
							</div> --}}

							@if ($proyecto->es_scrum_master())
								<div class="acciones_proyecto flex">
									<a href="#modal_invitar_integrante" rel="modal:open" class="accion_modal accion modal_agregar_nuevo_integrante_proyecto">
										<i class="agregar_nuevo_integrante_proyecto fas fa-user-plus"></i>
									</a>
									<a href="./proyecto/{{ $proyecto->id }}/editar" class="accion boton_editar_proyecto">
										<i class="editar_proyecto fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="accion_modal accion modal_eliminar_proyecto">
										<i class="eliminar_proyecto far fa-trash-alt"></i>
									</a>
								</div>
							@endif
						</div>
					</div>
				</div>
			@endforeach

			<form style="display: none;" id="formulario_eliminar_proyecto" action="/proyecto/{{ $proyecto->id }}" method="post">
				{{ method_field('DELETE') }}
				{{ csrf_field() }}
				<button type="submit" id="eliminar_proyecto" class="accion_modal accion modal_eliminar_proyecto">
					<i class="eliminar_proyecto far fa-trash-alt"></i>
				</button>
			</form>

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

			$(".modal_eliminar_proyecto").click(function(){
				$("#formulario_eliminar_proyecto").submit();
			})
		});
	</script>
@endsection
