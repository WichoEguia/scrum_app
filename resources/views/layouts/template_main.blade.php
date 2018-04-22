<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Scrum - @yield('titulo_vista')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
				<link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">

				<!-- Javascript Libraries -->
				<script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
				<script src="{{ asset('js/jquery.js') }}" charset="utf-8"></script>
				<script src="{{ asset('js/jquery-ui.js') }}" charset="utf-8"></script>
				<script src="{{ asset('js/sweetalert2.js') }}" charset="utf-8"></script>
    </head>
    <body>
				@include('layouts/_cabecera')
				@include('layouts/_navegacion_lateral')
				<div class="contenedor_principal">
						@yield('contenedor_principal')
				</div>
    </body>
		<script src="{{ asset('js/template.js') }}" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var template = new Template();

				template.setUrl("{{ url("/") }}");
				template.ev();
				// template.comprobar_navegacion();
			});
		</script>
</html>
