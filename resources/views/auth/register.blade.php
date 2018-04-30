@extends('layouts.template_login')
@section('titulo_vista', 'Registrarse')

@section('contenedor_principal')
	<form method="POST" action="{{ route('register') }}">
		{{ csrf_field() }}

		<div class="field">
			<label for="name">Nombre</label><br>
			<input id="name" type="text" name="name" value="{{ old('name') }}" autofocus>
			@if ($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
			@endif
		</div>

		<div class="field">
			<label for="email">Correo</label><br>
			<input id="email" type="email" name="email" value="{{ old('email') }}">
			@if ($errors->has('email'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</div>

		<div class="field">
			<label for="password">Contraseña</label><br>
			<input id="password" type="password" name="password" value="{{ old('password') }}">
			@if ($errors->has('password'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		</div>

		<div class="field">
			<label for="password">Comfirmar Contraseña</label><br>
			<input id="password-confirm" type="password" name="password_confirmation">
		</div>

		<div class="field">
			<input type="submit" name="" value="Enviar">
		</div>
	</form>
@endsection
