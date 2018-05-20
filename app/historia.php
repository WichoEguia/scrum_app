<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'importancia', 'estimacion', 'notas'];

		/**
		 * Establece relacion historia pertenece a usuario
		 *
		 * Establece relacion historia pertenece a usuario
		*/
		public function user(){
		  return $this->belongsTo('App\User');
		}

		/**
		 * Establece relacion historia pertenece a usuario
		 *
		 * Establece relacion historia pertenece a sprint
		*/
		public function sprint(){
		  return $this->belongsTo("App\Sprint");
		}
}
