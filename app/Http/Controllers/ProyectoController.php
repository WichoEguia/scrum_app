<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Sprint;
use App\User;
use App\Notificacion;
use Session;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
	/**
	 * index
	 *
	 * Despliega proyectos
	 */
	public function index(){
		  $proyectos = Auth::User()->proyectos;
			return view('./proyectos/index', [
				'proyectos' => $proyectos
			]);
		}

		/**
		 * create
		 *
		 * Crea nuevo proyecto
		 */
		public function create(){
      return view("./proyectos/create");
    }

		/**
		 * store
		 *
		 * Guarda un nuevo proyecto
		 */
		public function store(Request $request){
			$proyecto = Proyecto::create($request->all());
			$proyecto->users()->attach(Auth::User());

			$sprint = new Sprint();
			$sprint->puntos_esfuerzo = 0;
			$sprint->proyecto_id = $proyecto->id;
			$sprint->save();

			Session::put('proyecto_id', $proyecto->id);
			Session::put('proyecto_nombre', $proyecto->nombre);
			Session::put('sprint_actual', $sprint);

			return redirect("/proyectos");
		}

		/**
		 * edit
		 *
		 * Permite editar proyecto
		 */
		public function edit(Proyecto $proyecto){
			return view("./proyectos/edit", ["proyecto" => $proyecto]);
		}

		/**
		 * update
		 *
		 * Guarda cambios en un proyecto
		 */
		public function update(Proyecto $proyecto){
		  $proyecto->update(request()->all());

			return redirect("/proyectos");
		}

		/**
		 * destroy
		 *
		 * Elimina un proyecto
		 */
		public function destroy(Proyecto $proyecto){
		  $proyecto->delete();

			return redirect("/proyectos");
		}

		/**
		 * asociar_proyecto_usuario
		 *
		 * Crea las variables de seción de un proyecto nuevo
		 * @param Mixed $request
		 */
		public function asociar_proyecto_usuario(Request $request){
			Session::put('user_id', Auth::User()->id);
			Session::put('proyecto_id', $request->proyecto_id);
			Session::put('proyecto_nombre', Proyecto::find($request->proyecto_id)->nombre);

			return Session::get('proyecto_nombre');
		}

		/**
		 * invitar_usuario_proyecto
		 *
		 * Invita a un nuevo usuaro en el proyecto
		 * @param Mixed $request
		 * @return Boolean $resultado
		 */
		public function invitar_usuario_proyecto(Request $request){
			$resultado["resultado"] = false;
		  $usuario = User::where('email', $request->correo_usuario)->get();

			if (count((array)$usuario) > 0) {
				$usuario_sesion = Auth::User();
				if ($usuario[0]->email != $usuario_sesion->email) {
					$proyecto = Proyecto::find($request->id_proyecto_compartido);
					for ($i=0; $i < count((array)$proyecto->users); $i++) {
						$pase = ($usuario[0]->id != $proyecto->users->get($i)->id) ? true : false;
					}
					if ($pase) {
						$resultado["resultado"] = true;
						$proyecto->users()->attach($usuario[0]);

						Notificacion::insert([
							"titulo" => "¡Nuevo proyecto!",
							"descripcion" => "Has sido incluido en el proyecto " . $proyecto->nombre,
							"estatus" => "no_leido",
							"user_id" => $usuario[0]->id,
							"created_at" => date("Y-m-d")
						]);

					}	else {
						$resultado["mensaje"] = "El usuario ya ha sido invitado.";
					}
				} else {
					$resultado["mensaje"] = "No te puedes invitar a ti mismo.";
				}
			} else {
				$resultado["mensaje"] = "El usuario no tiene cuenta en la aplicación";
			}

			return $resultado;
		}
}
