<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = ['fecha_fin', 'puntos_esfuerzo'];

		public function users(){
		  return $this->belongsTo("App\Proyecto");
		}

		public function historias(){
			return $this->hasMany("App\Historia");
		}
}
