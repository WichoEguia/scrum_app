<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use File;
use Storage;
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

	public function update(Request $request, User $user){
		if ($request->file('userphoto')) {
			Storage::delete($user->userphoto);
		}

		$file = $request->file('userphoto');
		$nombre = strtotime(date('YmdHis')) . $file->getClientOriginalName();
		Storage::disk('local')->put($nombre, File::get($file));
		$user->name = $request->name;
		$user->email = $request->email;
		$user->userphoto = "/app/".$nombre;

		$user->save();

		return redirect("/perfil");
	}
}
