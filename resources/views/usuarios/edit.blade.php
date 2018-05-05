@extends('layouts/template_main')
@section('titulo_vista', 'Perfil')

@section('contenedor_principal')
	<form class="" action="" method="post">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}

		<div class="field">
			<label for="name">Nombre:</label><br>
			<input type="text" id="name" value="{{ isset($user) ? $user->name : '' }}">
		</div>

		<div class="field">
			<label for="password">Nueva contraseña (deja en blanco si no quieres actualizarla):</label><br>
			<input type="password" id="password">
		</div>

		<div class="field">
			<label for="new_password">Confirmar contraseña (deja en blanco si no quieres actualizarla):</label><br>
			<input type="password" id="new_password">
		</div>

		<div class="field">
			<label>Agregar foto de usuario</label><br><br>
			<input type="file" id="userphoto" value="">
			<label for="userphoto" class="flex centerX centerY">
				<i class="fas fa-camera"></i>
				Foto de usuario
			</label>
		</div>
	</form>
@endsection
