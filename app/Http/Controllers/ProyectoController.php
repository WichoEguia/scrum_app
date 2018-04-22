<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Sprint;
use Session;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
		public function index(){
		  $proyectos = Auth::User()->proyectos;
			return view('./proyectos/index', ['proyectos' => $proyectos]);
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
}
