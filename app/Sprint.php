<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = ['fecha_fin', 'puntos_esfuerzo'];

		/**
		 * Establece relacion proyecto pertenece a sprint
		 *
		 * Establece relacion proyecto pertenece a sprint
		*/
		public function proyecto(){
		  return $this->belongsTo("App\Proyecto");
		}

		/**
		 * Establece relacion sprint tiene varias historias
		 *
		 * Establece relacion sprint tiene varias historias
		*/
		public function historias(){
			return $this->hasMany("App\Historia");
		}
}
