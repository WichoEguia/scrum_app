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

		$(".tarjeta_proyecto").click(function(){
			var id_proyecto = $(this).children(".id_proyecto").val();
			localStorage.setItem("id_proyecto", id_proyecto);
		});
	}
}
