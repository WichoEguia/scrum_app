<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notificacion;
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
}
