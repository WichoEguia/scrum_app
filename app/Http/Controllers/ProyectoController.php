<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
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
			return redirect("/proyectos");
		}

		public function asociar_proyecto_usuario(Request $request){
		  $userdata = [
				'user_id' => Auth::User()->id,
				'proyecto_id' => $request->proyecto_id
			];
			Session::put('user', $userdata);

			return Proyecto::find($request->proyecto_id)->nombre;
		}
}
