<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'estatus', 'created_at'];

		/**
		 * Establece relacion notificación pertenece a usuario
		 *
		 * Establece relacion notificación pertenece a usuario
		*/
		public function user(){
		  return $this->belongsTo('App\User');
		}
}
