<header>
		<div class="contenedor_cabecera">
				<i class="toggle_navegacion fa fa-bars"></i>

				@auth
					<div class="datos_usuario_cabecera">
							<div class="foto_perfil">
									<img src="{{ asset('img/perfil_foto_prueba.jpg') }}" alt="">
							</div>
							<span>{{ Auth::user()->name }}</span>
							<div class="boton_opciones_usuario">
									<i class="fas fa-angle-down"></i>
							</div>
					</div>
				@endauth
		</div>
</header>

<div class="panel_opciones_usuario">
	<div class="flex">
		<div class="opcion_usuario_item flex centerX centerY">
			<i class="fas fa-address-card"></i>
		</div>
		<div class="opcion_usuario_item flex centerX centerY">
			<i class="fas fa-cog"></i>
		</div>

		<a href="{{ route("logout") }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
			<div class="opcion_usuario_item flex centerX centerY">
				<i class="fas fa-sign-out-alt"></i>
			</div>
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
		</form>
	</div>
</div>
