@extends('layouts.template_main')

@section('contenedor_principal')
	<form method="POST" action="{{ route('login') }}">
		{{ csrf_field() }}

		<div class="field">
			<label for="email">Correo</label><br>
			<input id="email" type="email" name="email" value="{{ old('email') }}" autofocus>
			@if ($errors->has('email'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</div>

		<div class="field">
			<label for="password">Contraseña</label><br>
			<input id="password" type="password" name="password">
			@if ($errors->has('password'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		</div>

		<div class="field">
			<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
			<label for="remember">Recuerdame</label>
		</div>

		<div class="field">
			<input type="submit" name="" value="Enviar">
		</div>

		<a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
	</form>
@endsection
