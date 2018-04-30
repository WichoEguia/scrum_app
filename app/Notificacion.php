<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'estatus', 'created_at'];

		public function user(){
		  return $this->belongsTo('App\User');
		}
}
