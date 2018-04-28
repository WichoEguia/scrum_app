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
		$("#invitar_usuario_proyecto").off();

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

		$("#invitar_usuario_proyecto").click(function(){
			$.ajax({
		    method : "post",
		    url : base_url + "/invitar_usuario_proyecto",
		    async : true,
		    data : {
					_token: $('#token').val(),
					correo_usuario: $("#correo_usuario").val()
				}
			}).done(function(data){
				if (!data.resultado) {
					swal("Error al enviar", data.mensaje, "error");
				} else {
					swal("Yay","¡El usuario ya forma parte de tu equipo!","success").then(function(){
						$("#correo_usuario").val("");
						$(".close-modal").click();
					});
				}
			});
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
