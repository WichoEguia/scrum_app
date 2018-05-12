<aside class="navegacion_lateral">
	<ul class="flex">
		<div class="accion_navegacion_lateral">
			<li class="flex centerY">
				@yield('accion_navegacion_lateral')
			</li>
		</div>

		<div class="flex">
			<li class="flex centerY">
				<a href="{{ route('ruta_proyectos') }}">
					Proyectos
				</a>
			</li>
			<li class="flex centerY">
				<a href="{{ route('scrum_board') }}">
					Scrum Board
				</a>
			</li>
			<li class="flex centerY">
				<a href="{{ route('burndown_chart') }}">
					Burndown Chart
				</a>
			</li>
		</div>
	</ul>
</aside>
