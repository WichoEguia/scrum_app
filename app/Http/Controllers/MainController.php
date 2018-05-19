<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notificacion;
use App\Sprint;
use Session;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
	public function actualizar_notificacion(Request $request){
		$resultado["resultado"] = false;

	  $notificacion = Notificacion::find($request->id_notificacion);
		if (count($notificacion) > 0) {
			$resultado["resultado"] = true;

			$notificacion->estatus = "leido";
			$notificacion->updated_at = date('Y-m-d h:i:s');
			$notificacion->save();
		}

		return $resultado;
	}

	public function fin_sprint(Sprint $sprint){
		$sprint->estatus = 'cancelado';
		$sprint->save();

		$nuevo_sprint = new Sprint();
		$nuevo_sprint->puntos_esfuerzo = 0;
		$nuevo_sprint->proyecto_id = Session::get('proyecto_id');
		$nuevo_sprint->save();

		Session::put('sprint_actual', $sprint);

		return redirect("/scrumboard");
	}
}
