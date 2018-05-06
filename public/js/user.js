function User(){
	var base_url = "";

	this.setUrl = function(url){
		base_url = url;
	}

	this.ev = function(){
		eventos();
	}

	var eventos = function(){
		$("#formulario_editar_usuario").off();

		$("#formulario_editar_usuario").submit(function(e){
			var nombre = $("#name").val();
			var email = $("#email").val();

			var paso = validar_datos(nombre, email);
			if (!paso) {
				e.preventDefault();
				swal("Error al enviar", "Asegurate de llenar correctamente los campos para continuar.","error");
			}
		});
	}

	var validar_datos = function(nombre, email){
		$(".campo_error").removeClass("campo_error");
		var res_n = false;
		var res_e = false;
		var resultado = false;
		var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

		if (nombre != "") {
			res_n = true;
		} else {
			$("#name").addClass("campo_error");
		}

		if (email != "" && re.test(email)) {
			res_e = true;
		} else {
			$("#email").addClass("campo_error");
		}

		if (res_n && res_e) {
			resultado = true;
		}

		return resultado;
	}
}
