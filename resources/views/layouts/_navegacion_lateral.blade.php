<aside class="navegacion_lateral activo">
	<i class="toggle_navegacion icono_navegacion fas fa-times"></i>

	<div class="encabezado_navegacion">
		<p><span>DS</span><span>LAB</span></p>
	</div>

	<ul class="grupo_navegacion_items">
		<li>
			<a href="{{ route('raiz') }}" class="navegacion_item">
				<i class="fa fa-home"></i>
				Inicio
			</a>
		</li>
		<li>
			<a href="#" class="navegacion_item">
				<i class="fa fa-table"></i>
				Task Board
			</a>
		</li>
		<li>
			<a href="#" class="navegacion_item">
				<i class="far fa-chart-bar"></i>
				Burndown Chart
			</a>
		</li>
		<li>
			<a href="#" class="navegacion_item">
				<i class="fas fa-users"></i>
				Equipo
			</a>
		</li>
		<hr>
		<li>
			<a href="{{ route('nueva_historia') }}" class="navegacion_item">
				<i class="fa fa-plus"></i>
				Agregar Historia
			</a>
		</li>
	</ul>
</aside>
