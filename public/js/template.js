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

			$(document).mouseup(function(e){
		    var container = $(".panel_opciones_usuario");

		    if (!container.is(e.target) && container.has(e.target).length === 0){
		        container.removeClass("activo");
		    }
			});
		});

		$(".toggle_navegacion").click(function(){
			$(".navegacion_lateral").toggleClass("activo")
		});

		$(".contenedor_notificacion.no_leido").click(function(){
			$(this).removeClass("no_leido").addClass("leido");
			$.ajax({
			    method : "post",
			    url : base_url + "/actualizar_notificacion",
			    async : true,
			    data : {
						"id_notificacion" : $(this).children(".id_notificacion").val(),
						_token: $("#token").val()
					}
			}).done(function(data){
				if (data.resultado) {
					$(".foto_perfil > div").attr('data-badge', parseInt($(".foto_perfil > div").attr('data-badge')) - 1);
				}

				$(".close-modal").click();
			});
		});
	}
}
