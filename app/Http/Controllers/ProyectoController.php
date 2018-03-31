<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
		public function index(){
		  $proyectos = Proyecto::all();
			return view('./proyectos/index', ['proyectos' => $proyectos]);
		}

    public function create(){
      return view("./proyectos/create");
    }

		public function store(Request $request){
			Proyecto::create($request->all());
			return redirect("/proyectos");
		}
}
