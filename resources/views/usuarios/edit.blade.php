@extends('layouts/template_main')
@section('titulo_vista', 'Perfil')

@section('contenedor_principal')
	<form id="formulario_editar_usuario" action="/user/{{ $user->id }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}

		<div class="field">
			<label for="name">Nombre:</label><br>
			<input type="text" name="name" id="name" value="{{ isset($user) ? $user->name : '' }}">
		</div>

		<div class="field">
			<label for="email">Correo:</label><br>
			<input type="text" name="email" id="email" value="{{ isset($user) ? $user->email : '' }}">
		</div>

		<div class="field">
			<label>Agregar foto de usuario</label><br><br>
			<input type="file" name="userphoto" id="userphoto" value="">
			<label for="userphoto" class="flex centerX centerY">
				<i class="fas fa-camera"></i>
				Foto de usuario
			</label>
		</div>

		<div class="field">
			<input type="submit" id="enviar_formulario_editar_usuario" value="Enviar ">
		</div>
	</form>

	<script src="{{ asset('js/user.js') }}" charset="utf-8"></script>
	<script type="text/javascript">
		var user = new User();
		user.setUrl("{{ url('/') }}");
		user.ev();
	</script>
@endsection
