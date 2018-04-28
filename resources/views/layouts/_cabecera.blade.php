<header>
	<div class="contenedor_cabecera">
		<div class="toggle_navegacion flex centerY">
			@auth
				<i class="fa fa-bars"></i>
				<div class="titulo--proyecto flex">
					<span class="titulo_vista">@yield('titulo_vista')</span>
					<span class="nombre_proyecto">Proyecto: {{ Session::get('proyecto_nombre') }}</span>
				</div>
			@endauth

			@guest
				<span class="titulo_vista">@yield('titulo_vista')</span>
			@endguest
		</div>

		@auth
			<div class="datos_usuario_cabecera">
					<div class="foto_perfil">
						<div data-badge="{{ Auth::User()->numero_notificaciones() }}">
							<img src="{{ asset('img/perfil_foto_prueba.jpg') }}">
						</div>
					</div>
					<span>{{ Auth::user()->name }}</span>
					<div class="boton_opciones_usuario">
							<i class="fas fa-angle-down"></i>
					</div>
			</div>
		@endauth

		@guest
			<div class="enlaces_login">
				<a href="{{ route('login') }}">Entrar</a>
				<a href="{{ route('register') }}">Registrarse</a>
			</div>
		@endguest
	</div>
</header>

<div class="panel_opciones_usuario">
	<div class="flex">
		<div class="opcion_usuario_item flex centerX centerY">
			<i class="fas fa-address-card"></i>
		</div>

		<a href="#modal_notificaciones" rel="modal:open" class="accion_modal">
			<div class="opcion_usuario_item flex centerX centerY">
				<i class="fas fa-bell"></i>
			</div>
		</a>

		<a href="{{ route("logout") }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
			<div class="opcion_usuario_item flex centerX centerY">
				<i class="fas fa-sign-out-alt"></i>
			</div>
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
		</form>
	</div>

	@auth
		@if (count(Auth::User()->notificaciones))
			@include('./layouts/_modales', ["notificaciones" => Auth::User()->notificaciones])
		@endif
	@endauth
</div>
