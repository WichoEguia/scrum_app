<div id="modal_notificaciones" class="modal">
	<p class="titulo_vista">Notificaciones</p>
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	@if (count((array)$notificaciones) > 0)
		@foreach ($notificaciones as $notificacion)
			@if ($notificacion->estatus == 'no_leido')

				<div class="contenedor_notificacion no_leido">
					<input class="id_notificacion" type="hidden" value="{{ $notificacion->id }}">
					<strong>{{ $notificacion->titulo }}</strong>
					<p>{{ $notificacion->descripcion }}</p>
					<p class="fecha_notificacion">{{ substr($notificacion->created_at, 0, 10) }}</p>
				</div>

			@else

				<div class="contenedor_notificacion leido">
					<input class="id_notificacion" type="hidden" value="{{ $notificacion->id }}">
					<strong>{{ $notificacion->titulo }}</strong>
					<p>{{ $notificacion->descripcion }}</p>
					<p class="fecha_notificacion">{{ substr($notificacion->created_at, 0, 10) }}</p>
				</div>

			@endif
		@endforeach
	@else
		<p class="sin_notificaciones">No hay notificaciones que mostrar.</p>
	@endif
</div>
