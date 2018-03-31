{{ csrf_field() }}

<div class="field">
	<label for="historia_titulo">Titulo</label><br>
	<input type="text" name="titulo" id="historia_titulo">
</div>

<div class="field">
	<label for="historia_descripcion">Descripción</label><br>
	<textarea name="descripcion" id="historia_descripcion"></textarea>
</div>

<div class="field_set flex">
	<div class="field">
		<label for="historia_importancia">Importancia</label><br>
		<input type="number" name="importancia" id="historia_importancia" min="10" max="100">
	</div>

	<div class="field">
		<label for="historia_estimacion">Estimación</label><br>
		<input type="number" name="estimacion" id="historia_estimacion" min="10" max="100">
	</div>
</div>

<div class="field">
	<label for="historia_notas">Notas</label><br>
	<textarea name="notas" id="historia_notas"></textarea>
</div>
