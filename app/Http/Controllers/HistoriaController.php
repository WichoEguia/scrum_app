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
				$historias = [];
				$proyectos = Auth::User()->proyectos;

				// TODO: Bloquear LINK en navegación
				if (!Session::get('proyecto_id')) {
					return redirect('/');
				}

				$sprint = Sprint::where('proyecto_id', Session::get('proyecto_id'))->where('estatus', 'activo')->first();
				if (count($sprint) > 0) {
					$historias = $sprint->historias->where('estatus', '!=', 'baja');
				}

        return view("./scrum_board",[
					"historias" => $historias,
					"proyectos" => $proyectos,
					"proyecto_id" => Session::get('proyecto_id'),
					"scrum_master" => Proyecto::find(Session::get('proyecto_id'))->es_scrum_master() ? '1' : '0'
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Historia $historia)
    {
      return view('./historias/edit', ['historia' => $historia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Historia $historia)
    {
			$historia->update(request()->all());

			return redirect("/scrumboard");
    }

		/**
     * Actualiza estatus de cierta tarea.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function actualiza_estatus_tarea(Request $request){
			$historia = Historia::find($request->historia_id);
			$historia->estatus = $request->estado;
			$historia->save();
		}

		/**
		 * burndown_chart
		 *
     * Carga vista para dibujar burndown chart.
     */
    public function burndown_chart(){
			if (!Session::get('proyecto_id')) {
				return redirect('/');
			}

			$puntos_esfuerzo = [];
			$fechas = [];
			$sprint = Sprint::where('proyecto_id', Session::get('proyecto_id'))->where('estatus', 'activo')->first();
			$historias_terminadas = $sprint->historias->where('estatus', 'done')->sortByDesc('updated_at')->reverse();
			$puntos_esfuerzo_total = $sprint->puntos_esfuerzo;
			$proyecto = Proyecto::find(Session::get('proyecto_id'));
			$sprints = Sprint::where('proyecto_id', Session::get('proyecto_id'))->where('estatus', 'cancelado')->get();

			foreach ($historias_terminadas as $historia) {
				array_push($puntos_esfuerzo, $historia["estimacion"]);
				array_push($fechas, $historia["updated_at"]->format('Y-m-d'));
			}
			// dd($sprint_actual);

	  	return view('/historias/burndown_chart', [
				'puntos_esfuerzo' => json_encode($puntos_esfuerzo),
				'fechas' => json_encode($fechas),
				'puntos_esfuerzo_total' => $puntos_esfuerzo_total,
				'proyecto' => $proyecto,
				'sprint_actual' => $sprint,
				'sprints' => $sprints
			]);
		}

		/**
		 * baja_historia
		 *
     * Dar de baja una historia.
		 * @param Mixed $historia
     */
    public function baja_historia(Historia $historia){
		  $historia->estatus = "baja";
			$historia->save();
			return redirect('/scrumboard');
		}
}
