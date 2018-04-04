function Proyectos(){
	var base_url = "";

	this.setUrl = function(url){
		base_url = url;
	}

	this.ev = function(){
		eventos();
	}

	var eventos = function(){
		$(".tarjeta_proyecto").off();
		$(".formulario_crear_proyectos").off();

		$(".tarjeta_proyecto").click(function(){
			var id_proyecto = $(this).children(".id_proyecto").val();
			localStorage.setItem("id_proyecto", id_proyecto);

			var nombre_proyecto = $(".titulo_proyecto").text();
			swal("Listo", "Seleccionado proyecto " + nombre_proyecto, "success");
		});

		$(".formulario_crear_proyectos").submit(function(e){
			var fp_nombre = $("#proyecto_nombre").val();
			var fp_descripcion = $("#proyecto_descripcion").val();

			if (!validar_campos_formulario(fp_nombre, fp_descripcion)) {
				e.preventDefault();
				swal("Error al enviar", "Llena todos los campos para continuar", "error");
			}
		});
	}

	var validar_campos_formulario = function(fp_nombre, fp_descripcion){
		$(".campo_error").removeClass("campo_error");
		var resultado = false;
		var nombre = false;
		var descripcion = false;

		if (fp_nombre != "") {
			nombre = true;
		} else {
			$("#proyecto_nombre").addClass("campo_error");
		}

		if (fp_descripcion != "") {
			descripcion = true;
		} else {
			$("#proyecto_descripcion").addClass("campo_error");
		}

		if (nombre && descripcion) {
			resultado = true;
		}

		return resultado;
	}
}
