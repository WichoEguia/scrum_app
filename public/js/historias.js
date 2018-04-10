function Historias(){
	var base_url = "";

	this.setUrl = function(url){
		base_url = url;
	}

	this.ev = function(){
		eventos();
	}

	var eventos = function(){
		$(".formulario_historias").off();

		$(".formulario_historias").submit(function(e){
			var fp_titulo = $("#historia_titulo").val();
			var fp_descripcion = $("#historia_descripcion").val();
			var fp_importancia = $("#historia_importancia").val();
			var fp_estimacion = $("#historia_estimacion").val();
			var fp_notas = $("#historia_notas").val();

			if (!validar_campos_formulario(fp_titulo, fp_descripcion, fp_importancia, fp_estimacion, fp_notas)) {
				e.preventDefault();
				swal("Error al enviar", "Llena todos los campos para continuar", "error");
			}
		});
	}

	var validar_campos_formulario = function(fp_titulo, fp_descripcion, fp_importancia, fp_estimacion, fp_notas){
		$(".campo_error").removeClass("campo_error");
		var resultado = false;
		var titulo = false;
		var descripcion = false;
		var importancia = false;
		var estimacion = false;
		var notas = false;

		if (fp_titulo != "") {
			titulo = true;
		} else {
			$("#historia_titulo").addClass("campo_error");
		}

		if (fp_descripcion != "") {
			descripcion = true;
		} else {
			$("#historia_descripcion").addClass("campo_error");
		}

		if (fp_importancia != "") {
			importancia = true;
		} else {
			$("#historia_importancia").addClass("campo_error");
		}

		if (fp_estimacion != null) {
			estimacion = true;
		} else {
			$("#historia_estimacion").addClass("campo_error");
		}

		if (fp_notas != "") {
			notas = true;
		} else {
			$("#historia_notas").addClass("campo_error");
		}

		if (titulo && descripcion && importancia && estimacion && notas) {
			resultado = true;
		}

		return resultado;
	}
}
