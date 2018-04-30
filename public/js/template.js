function Template(){
	var base_url = "";

	this.setUrl = function(url){
		base_url = url;
	}

	this.ev = function(){
		eventos();
	}

	var eventos = function(){
		$(".datos_usuario_cabecera").off();
		$(".toggle_navegacion").off();

		$(".datos_usuario_cabecera").click(function(){
			$(".panel_opciones_usuario").toggleClass("activo");
		});

		$(".toggle_navegacion").click(function(){
			$(".navegacion_lateral").toggleClass("activo")
		});

		$(".contenedor_notificacion.no_leido").click(function(){
			$.ajax({
			    method : "post",
			    url : base_url + "/actualizar_notificacion",
			    async : true,
			    data : {
						"id_notificacion" : $(this).children(".id_notificacion").val(),
						_token: $("#token").val()
					}
			}).done(function(data){
				$(".close-modal").click();
			});
		});
	}
}
