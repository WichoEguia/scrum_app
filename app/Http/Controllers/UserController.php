<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index(){
		$usuario = Auth::User();
		$proyectos = Auth::User()->proyectos;

		return view('usuarios/index',
			['usuario' => $usuario, 'proyectos' => $proyectos]
		);
  }

	public function edit(User $user){
	  return view('usuarios/edit', ['user' => $user]);
	}
}
