<aside class="navegacion_lateral">
	<i class="toggle_navegacion icono_navegacion fas fa-times"></i>

	<div class="encabezado_navegacion">
		<p><span>DS</span><span>LAB</span></p>
	</div>

	<ul class="grupo_navegacion_items">
	<li>
		<a href="{{ route('ruta_proyectos') }}" class="navegacion_item">
			<i class="fas fa-users"></i>
			Proyectos
		</a>
	</li>
		<li>
			<a href="{{ route('scrum_board') }}" class="navegacion_item">
				<i class="fa fa-table"></i>
				Scrum Board
			</a>
		</li>
		<li>
			<a href="{{ route('burndown_chart') }}" class="navegacion_item">
				<i class="far fa-chart-bar"></i>
				Burndown Chart
			</a>
		</li>
		<li>
			<a href="{{ route('burndown_chart') }}" class="navegacion_item">
				<i class="fas fa-cog"></i>
				Duración Sprints
			</a>
		</li>
	</ul>
</aside>
