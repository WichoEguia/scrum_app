<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
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
}
