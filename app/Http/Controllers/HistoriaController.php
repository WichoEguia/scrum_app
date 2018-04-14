<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historia;
use App\Proyecto;
use Session;
use Illuminate\Support\Facades\Auth;

class HistoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
				$proyectos = Auth::User()->proyectos;
				$historias = Historia::all();

        return view("./scrum_board",[
					"historias" => $historias,
					"proyectos" => $proyectos,
					"proyecto_id" => Session::get('proyecto_id')
				]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("./historias/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
				$sprint = Proyecto::find(Session::get('proyecto_id'))->sprints->sortByDesc('created_at')->first();
				$historia = new Historia();
				$historia->titulo = $request->titulo;
				$historia->descripcion = $request->descripcion;
				$historia->importancia = $request->importancia;
				$historia->estimacion = $request->estimacion;
				$historia->notas = $request->notas;
				$historia->sprints_id = $sprint->id;
				$historia->users_id = Session::get('user_id');

				$historia->save();

				$historias = Historia::all()->where('sprints_id', $sprint->id);
				if (count($historias) == 1) {
					$sprint->estatus = 'activo';
				}
				$sprint->puntos_esfuerzo += $request->estimacion;
				$sprint->save();
				
				return redirect("/scrumboard");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

		public function actualiza_estatus_tarea(Request $request){
			$historia = Historia::find($request->historia_id);
			$historia->estatus = $request->estado;
			$historia->save();
		}

		public function burndown_chart(){
			$estimacion = Auth::User()->historias->sum('estimacion');
			$cantidad_historias = count(Auth::User()->historias);

	  	return view('/historias/burndown_chart', [
				'estimacion' => $estimacion,
				'cantidad_historias' => $cantidad_historias
			]);
		}
}
