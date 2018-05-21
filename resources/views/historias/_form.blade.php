{{ csrf_field() }}

<div class="field">
	<label for="historia_titulo">Titulo</label><br>
	<input type="text" name="titulo" id="historia_titulo" value="{{ isset($historia) ? $historia->titulo : '' }}">
</div>

<div class="field">
	<label for="historia_descripcion">Descripción</label><br>
	<textarea name="descripcion" id="historia_descripcion">{{ isset($historia) ? $historia->descripcion : '' }}</textarea>
</div>

<div class="field_set flex">
	<div class="field">
		<label for="historia_importancia">Importancia</label><br>
		<input type="number" name="importancia" id="historia_importancia" min="10" max="100" value="{{ isset($historia) ? $historia->importancia : '' }}">
	</div>

	<div class="field">
		<label for="historia_estimacion">Estimación</label><br>
		<?php $opciones = ["0","1/2","1","2","3","5","8","13","20","40","100"]; ?>
		<select id="historia_estimacion" name="estimacion" value="{{ isset($historia) ? $historia->estimacion : '' }}">
			<option selected disabled>Selecciona</option>
			@for ($i=0; $i < count((array)$opciones); $i++)
				<option value="{{ $opciones[$i] == "1/2" ? "0.5" : $opciones[$i] }}">
					{{ $opciones[$i] }}
				</option>
			@endfor
		</select>
	</div>
</div>

<div class="field">
	<label for="historia_notas">Notas</label><br>
	<textarea name="notas" id="historia_notas">{{ isset($historia) ? $historia->notas : '' }}</textarea>
</div>

<script type="text/javascript">
	$("#historia_estimacion option[value='{{ isset($historia) ? $historia->estimacion : '' }}']").prop('selected', true);
</script>
