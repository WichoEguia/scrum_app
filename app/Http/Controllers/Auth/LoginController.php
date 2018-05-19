<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use App\Sprint;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/proyectos';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

		public function authenticated($request, $user) {
				Session::put('user_id', $user->id);
				if (!null == $user->proyectos()->first()) {
					Session::put('proyecto_id', $user->proyectos()->first()->id);
					Session::put('proyecto_nombre', $user->proyectos()->first()->nombre);
					Session::put('sprint_actual', $sprint = Sprint::where('proyecto_id', Session::get('proyecto_id'))->where('estatus', 'activo')->first());
				}
    }
}
