function Historias(){
	var base_url = "";

	this.setUrl = function(url){
		base_url = url;
	}

	this.ev = function(){
		eventos();
	}

	var eventos = function(){
		$(".formulario_historias").off();

		$(".formulario_historias").submit(function(e){
			var fp_titulo = $("#historia_titulo").val();
			var fp_descripcion = $("#historia_descripcion").val();
			var fp_importancia = $("#historia_importancia").val();
			var fp_estimacion = $("#historia_estimacion").val();
			var fp_notas = $("#historia_notas").val();

			if (!validar_campos_formulario(fp_titulo, fp_descripcion, fp_importancia, fp_estimacion, fp_notas)) {
				e.preventDefault();
				swal("Error al enviar", "Llena todos los campos para continuar", "error");
			}
		});
	}

	var validar_campos_formulario = function(fp_titulo, fp_descripcion, fp_importancia, fp_estimacion, fp_notas){
		$(".campo_error").removeClass("campo_error");
		var resultado = false;
		var titulo = false;
		var descripcion = false;
		var importancia = false;
		var estimacion = false;
		var notas = false;

		if (fp_titulo != "") {
			titulo = true;
		} else {
			$("#historia_titulo").addClass("campo_error");
		}

		if (fp_descripcion != "") {
			descripcion = true;
		} else {
			$("#historia_descripcion").addClass("campo_error");
		}

		if (fp_importancia != "") {
			importancia = true;
		} else {
			$("#historia_importancia").addClass("campo_error");
		}

		if (fp_estimacion != null) {
			estimacion = true;
		} else {
			$("#historia_estimacion").addClass("campo_error");
		}

		if (fp_notas != "") {
			notas = true;
		} else {
			$("#historia_notas").addClass("campo_error");
		}

		if (titulo && descripcion && importancia && estimacion && notas) {
			resultado = true;
		}

		return resultado;
	}

	this.dibuja_grafica = function(puntos_esfuerzo_total, puntos_esfuerzo, fechas){
		// console.log(fechas);
		// console.log(puntos_esfuerzo);
		resultado = reformar_grafica(fechas, puntos_esfuerzo);
		fechas = resultado.fechas;
		puntos_esfuerzo = resultado.puntos;

		$("#arr_puntos").val(puntos_esfuerzo.toString());
		$("#arr_fechas").val(fechas.toString());

		if (puntos_esfuerzo.length == 0) {
			swal("Sin progreso", "No hay historias finalizadas.", "warning");
		}

		$(function () {
		  $('#container').highcharts({
				chart:{
          events:{
            click:function(e){
							window.location.href = base_url + "/historia_terminadas_fecha/" + window.location.href.split('/')[4] + "/" + fechas[Math.floor(e.xAxis[0].value)];
              // alert('x: ' + fechas[Math.floor(e.xAxis[0].value)]);
							// $.ajax({
							//     method : "POST",
							//     url : base_url + "/historia_terminadas_fecha",
							//     async : false,
							//     data : {
							// 			_token : $("#token").val(),
							// 			fecha : fechas[Math.floor(e.xAxis[0].value)],
							// 			sprint_id : window.location.href.split('/')[4]
							// 		}
							// }).done(function(data){
								// console.log(data);
								// <div id="modal_historias_fecha" class="modal">
								// <p class="titulo_vista">Integrantes</p>
								// 	<ul>
								// 		@foreach ($proyecto->users as $user)
								// 			<li class="flex">
								// 				<div>
								// 					<p>{{ $user->name }}</p>
								// 					<p>{{ $user->email }}</p>
								// 				</div>
								//
								// 				<div class="flex centerY">
								// 					@if ($proyecto->scrum_master == $user->id)
								// 						<p><i class="far fa-star"></i></p>
								// 					@endif
								// 				</div>
								// 			</li>
								// 		@endforeach
								// 	</ul>
								// </div>
								// c = "";
								// c += '<div id="modal_historias_fecha" class="modal">';
								// c += '	<p class="titulo_vista">Historias</p>';
								// c += '	<ul>';
								// for (var i = 0; i < data.length; i++) {
								// 	c += '<li class="flex">';
								// 	c += '	<div>';
								// 	c += ' 		<p>' + data[i].titulo + '</p>';
								// 	c += ' 		<p>' + data[i].descripcion + '</p>';
								// 	c += '	</div>';
								// 	c += '</li>';
								// }
								// c += '	</ul>';
								// c += '</div>';

								// $('body').html(c);
								// $("#modal_modal_historias_fecha").click();

								// var a = document.createElement('a');
								// var linkText = document.createTextNode("my title text");
								// a.appendChild(linkText);
								// a.title = "my title text";
								// a.href = "#modal_historias_fecha";
								// a.rel = "modal:open";
								// a.class = "accion_modal";
								// a.click();
								// a.remove();
								// document.body.appendChild(a);
							// });
            }
          }
        },
		    title: {
		      text: 'Burndown Chart',
		      x: -20 //center
		    },
		    colors: ['blue', 'red'],
		    plotOptions: {
		      line: {
		        lineWidth: 3
		      },
		      tooltip: {
		        hideDelay: 200
		      }
		    },
		    xAxis: {
					title: {
		        text: 'Fechas'
		      },
					categories: fechas
		    },
		    yAxis: {
		      title: {
		        text: 'Puntos de esfuerzo'
		      },
		      plotLines: [{
		        value: 0,
		        width: 1
		      }]
		    },
		    tooltip: {
		      valueSuffix: ' hrs',
		      crosshairs: true,
		      shared: true
		    },
		    legend: {
		      layout: 'vertical',
		      align: 'right',
		      verticalAlign: 'middle',
		      borderWidth: 0
		    },
		    series: [{
		      name: 'Restante',
		      color: 'rgb(237, 59, 11)',
		      marker: {
		        radius: 6
		      },
		      data: puntos_esfuerzo
				}/*,{
					name: 'Ideal Burn',
		      color: 'rgba(255, 0, 0, 0.75)',
		      marker: {
		        radius: 6
		      },
		      data: [15,14,13,12,11,10,9,8,7,6,5,4,3,2,1]
				}*/]
		  });
		});
	}

	var obtener_fechas = function(){
		var dias = [];
		var dia = moment().startOf('week');;

		for (i = 0; i < 15; i++) {
			dias.push(moment(dia.toDate()).format('YYYY-MM-DD'));
			dia = dia.clone().add(1, 'd');
		}

		return dias;
	}

	var array_puntos_esfuerzo = function(puntos_esfuerzo){
		var arr_puntos_esfuerzo = [];

		for (var i = 1; i <= puntos_esfuerzo; i++) {
			arr_puntos_esfuerzo.push(i)
		}

		return arr_puntos_esfuerzo;
	}

	var reformar_grafica = function(fechas, puntos_esfuerzo){
		json_fechas = {};
		resultado = {
			"fechas" : [],
			"puntos" : []
		};

		for (var i = 0; i < fechas.length; i++) {
			json_fechas[fechas[i]] = Math.floor(puntos_esfuerzo[i]);
		}

		$.each(json_fechas, function(key, val){
			resultado.fechas.push(key);
			resultado.puntos.push(val);
		});

		return resultado;
	}
}
