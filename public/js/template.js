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

		$(window).resize(function(){
			comprobar_navegacion();
		});
	}

	this.comprobar_navegacion = function(){
		comprobar_navegacion();
	}

	var comprobar_navegacion = function(){
		var ancho_ventana = $(window).width();

		if(ancho_ventana < 1248){
			$(".navegacion_lateral").removeClass("activo");
		}else{
			$(".navegacion_lateral").addClass("activo");
		}
	}
}
