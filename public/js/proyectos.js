function Proyectos(){
	var base_url = "";

	this.setUrl = function(url){
		base_url = url;
	}

	this.ev = function(){
		eventos();
	}

	var eventos = function(){
		$(".datos_proyecto_inner").off();
		$(".formulario_crear_proyectos").off();

		$(".datos_proyecto_inner").click(function(){
			var id_proyecto = $(this).parent().parent().children(".id_proyecto").val();

			$.ajax({
			    method : "POST",
			    url : base_url + "/asociar_proyecto_usuario",
			    async : true,
			    data : {
						proyecto_id : id_proyecto,
						_token: $("#token").val()
					}
			}).done(function(data){
				swal("Listo", "Seleccionado proyecto " + data, "success").then(function(r){
					$(".nombre_proyecto").text("Proyecto: " + data);
				});
			});
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
