<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function create(){
      return view("./proyectos/create");
    }
}
