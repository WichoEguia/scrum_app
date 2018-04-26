<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Sprint;
use App\User;
use Session;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
		public function index(){
		  $proyectos = Auth::User()->proyectos;
			return view('./proyectos/index', [
				'proyectos' => $proyectos
			]);
		}

    public function create(){
      return view("./proyectos/create");
    }

		public function store(Request $request){
			$proyecto = Proyecto::create($request->all());
			$proyecto->users()->attach(Auth::User());

			Session::put('proyecto_id', $proyecto->id);
			Session::put('proyecto_nombre', $proyecto->nombre);

			$sprint = new Sprint();
			$sprint->puntos_esfuerzo = 0;
			$sprint->proyecto_id = Session::get('proyecto_id');
			$sprint->save();

			return redirect("/proyectos");
		}

		public function asociar_proyecto_usuario(Request $request){
			Session::put('user_id', Auth::User()->id);
			Session::put('proyecto_id', $request->proyecto_id);
			Session::put('proyecto_nombre', Proyecto::find($request->proyecto_id)->nombre);

			return Session::get('proyecto_nombre');
		}

		public function invitar_usuario_proyecto(Request $request){
			$resultado["resultado"] = false;
		  $usuario = User::where('email', $request->correo_usuario)->get();

			if (count($usuario) > 0) {
				$usuario_sesion = Auth::User();
				if ($usuario[0]->email != $usuario_sesion->email) {
					$resultado["resultado"] = true;

					$proyecto = Proyecto::find(Session::get('proyecto_id'));
					$proyecto->users()->attach($usuario[0]);
				} else {
					$resultado["mensaje"] = "No te puedes invitar a ti mismo.";
					echo var_dump(1);
				}
			} else {
				$resultado["mensaje"] = "El usuario no tiene cuenta en la aplicación";
				echo var_dump(2);
			}

			return $resultado;
		}
}
