function Board(){
	var base_url = "";
	var historias = [];
	var proyectos = [];

	this.setUrl = function(url){
		base_url = url;
	}

	this.ev = function(){
		eventos();
	}

	var eventos = function(){
		// console.log("hi");

		$(".tarjeta_historia").draggable({
			connectToSortable: ".columna_scrum_board",
			cursor: "move",
			revert: "invalid"
		});

		$(".columna_scrum_board").droppable({
			drop: function(event, ui){
				drop_item($(this), ui.draggable.attr("id"));

				switch ($(this).attr("id")) {
					case "backlog_list":
					var estado = "no_iniciado";
					break;
					case "por_hacer":
					var estado = "por_hacer";
					break;
					case "iniciado":
					var estado = "iniciado";
					break;
					case "terminado":
					var estado = "terminado";
					break;
				}
				var historia_id = historias[ui.draggable.attr("id")].id;

				actualiza_estatus_tarea(historia_id, estado);
			}
		});
	}

	this.generar_historias = function(historias_){
		historias = historias_;
		// console.log(historias);
		for (var i = 0; i < historias.length; i++) {
			c = string_trjeta(i);

			switch (historias[i].estatus) {
				case "no_iniciado":
				$("#backlog_list").append(c);
				break;

				case "por_hacer":
				$("#por_hacer").append(c);
				break;

				case "iniciado":
				$("#iniciado").append(c);
				break;

				case "terminado":
				$("#terminado").append(c);
				break;
			}
		}

		eventos();
	}

	var drop_item = function(padre, hijo){
		nuevo_padre_id = padre.attr("id");
		hijo_id = hijo;

		$("#"+hijo_id).remove();

		c = string_trjeta(hijo_id);

		$("#"+nuevo_padre_id).append(c);

		eventos();
	}

	var actualiza_estatus_tarea = function(historia_id, estado){
		$.ajax({
	    method : "post",
	    url : base_url + "/actualiza_historia",
	    async : true,
	    data : {
				_token: $('#token').val(),
				historia_id: historia_id,
				estado: estado
			}
		}).done(function(data){});
	}

	var string_trjeta = function(i){
		c = "";
		c += "<div class='tarjeta_historia' id='" + i + "'>";
		c += "	<div class='idhistoria flex'>";
		c += "		<div class='flex centerX centerY'>";
		c += "			<p>" + historias[i].id + "</p>";
		c += "		</div>";
		c += "	</div>";
		c += "	<p class='historia_titulo'>" + historias[i].titulo + "</p>";
		c += "	<div class='historia_descripcion'>";
		c += "		<p>" + historias[i].descripcion + "</p>";
		c += "	</div>";
		c += "	<div class='flex'>";
		c += "		<p class='importancia'>" + historias[i].importancia + "</p>";
		c += "		<p class='estimacion'>" + historias[i].estimacion + "</p>";
		c += "	</div>";
		c += "</div>";

		return c;
	}

	this.validaciones_proyectos = function(proyectos_, proyecto_id_){
		proyectos = proyectos_;
		proyecto_id = proyecto_id_;
		if (!proyectos.length > 0) {
			swal("Sin Proyectos", "Usted no cuenta con ningun proyecto dado de alta.", "error").then(function(response){
				window.location.href = base_url + "/proyecto/nuevo";
			});
		} else if (!proyecto_id) {
			swal("Selecciona un proyecto", "Para continuar, Selecciona un proyecto", "error").then(function(response){
				window.location.href = base_url + "/proyectos";
			});
		} else if (!historias.length > 0) {
			swal("Sin Historias", "Para continuar debes dar de alta alguna historia de usuario", "error").then(function(response){
				// window.location.href = base_url + "/historia/nuevo";
			});
		}
	}
}
