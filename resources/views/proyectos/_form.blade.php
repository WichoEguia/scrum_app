{{ csrf_field() }}

<input type="hidden" name="scrum_master" value="{{ Auth::User()->id }}">

<div class="field">
	<label for="proyecto_nombre">Nombre</label><br>
	<input type="text" name="nombre" id="proyecto_nombre">
</div>

<div class="field">
	<label for="proyecto_descripcion">Descripción</label><br>
	<textarea name="descripcion" id="proyecto_descripcion"></textarea>
</div>

<div class="field">
	<label for="proyecto_sprints">Duracion de los sprints</label><br>
	<select class="" name="duracion_sprints">
		@for ($i=0; $i < 4; $i++)
			<option value="{{ $i+1 }}">{{ $i+1 . " semanas" }}</option>
		@endfor
	</select>
</div>
