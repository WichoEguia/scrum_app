<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historia;
use App\Proyecto;
use App\Sprint;
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
				$historia->sprint_id = $sprint->id;
				$historia->user_id = Session::get('user_id');
				$historia->save();

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
			$puntos_esfuerzo = [];
			$fechas = [];
			$historias_terminadas = Auth::User()->historias->where('estatus', 'done');
			$puntos_esfuerzo_total = Sprint::where('proyecto_id', Session::get('proyecto_id'))->first()->puntos_esfuerzo;

			foreach ($historias_terminadas as $historia) {
				array_push($puntos_esfuerzo, $historia["estimacion"]);
				array_push($fechas, $historia["updated_at"]->format('Y-m-d'));
			}
			// dd($fechas);

	  	return view('/historias/burndown_chart', [
				'puntos_esfuerzo' => json_encode($puntos_esfuerzo),
				'fechas' => json_encode($fechas),
				'puntos_esfuerzo_total' => $puntos_esfuerzo_total
			]);
		}
}
