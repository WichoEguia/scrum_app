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
		<?php $opciones = ["0","1/2","1","2","3","5","8","13","20","40","100"]; ?>
		<select id="historia_estimacion" name="estimacion">
			<option selected disabled>Selecciona</option>
			@for ($i=0; $i < count($opciones); $i++)
				<option value="{{ $opciones[$i] == "1/2" ? "0.5" : $opciones[$i] }}">
					{{ $opciones[$i] }}
				</option>
			@endfor
		</select>
	</div>
</div>

<div class="field">
	<label for="historia_notas">Notas</label><br>
	<textarea name="notas" id="historia_notas"></textarea>
</div>
