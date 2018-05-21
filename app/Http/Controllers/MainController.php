<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notificacion;
use App\Sprint;
use App\Historia;
use Session;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
	/**
	 * actualizar_notificacion
	 *
	 * Actualiza notificación leida
	 * @param Mixed $request
	 */
	public function actualizar_notificacion(Request $request){
		$resultado["resultado"] = false;

	  $notificacion = Notificacion::find($request->id_notificacion);
		if (count((array)$notificacion) > 0) {
			$resultado["resultado"] = true;

			$notificacion->estatus = "leido";
			$notificacion->updated_at = date('Y-m-d h:i:s');
			$notificacion->save();
		}

		return $resultado;
	}

	/**
	 * fin_sprint
	 *
	 * Finaliza el sprint en curso
	 * @param Mixed $request
	 */
	public function fin_sprint(Request $request){
		// dd($request->all());
		$sprint = Sprint::find($request->sprint);
		$arr_puntos = $request->arr_puntos;
		$arr_fechas = $request->arr_fechas;

		$sprint->estatus = 'cancelado';
		$sprint->arr_puntos = $arr_puntos;
		$sprint->arr_fechas = $arr_fechas;
		$sprint->save();

		$nuevo_sprint = new Sprint();
		$nuevo_sprint->puntos_esfuerzo = 0;
		$nuevo_sprint->proyecto_id = Session::get('proyecto_id');
		$nuevo_sprint->save();

		Session::put('sprint_actual', $sprint);

		return redirect("/scrumboard");
	}

	/**
	 * var_sprint
	 *
	 * Permite ver un sprint terminado
	 * @param Mixed $request
	 */
	public function ver_sprint(Sprint $sprint){
		$historias = Sprint::find($sprint->id)->historias;
	  return view('./sprints/show', [
			'sprint' => $sprint,
			'historias' => $historias
		]);
	}
}
