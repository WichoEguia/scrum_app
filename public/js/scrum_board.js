function Board(){
	var base_url = "";
	var historias = [];

	this.setUrl = function(url){
		base_url = url;
	}

	this.ev = function(){
		eventos();
	}

	var eventos = function(){
		console.log("hi");

		$(".tarjeta_historia").draggable({
			connectToSortable: ".columna_scrum_board",
			cursor: "move",
			revert: "invalid"
		});

		$(".columna_scrum_board").droppable({
			drop: function(event, ui){
				drop_item($(this), ui.draggable.attr("id"));
			}
		});
	}

	this.generar_historias = function(historias_){
		historias = historias_;
		console.log(historias);
		for (var i = 0; i < historias.length; i++) {
			c = "";
			c += "<div class='tarjeta_historia' id='" + i + "'>";
			c += "	<p>" + historias[i].titulo + "</p>";
			c += "	<p>" + historias[i].descripcion + "</p>"
			c += "</div>";

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

		c = "";
		c += "<div class='tarjeta_historia' id='" + hijo_id + "'>";
		c += "	<p>" + historias[hijo_id].titulo + "</p>";
		c += "	<p>" + historias[hijo_id].descripcion + "</p>"
		c += "</div>";

		$("#"+nuevo_padre_id).append(c);

		eventos();
	}
}
