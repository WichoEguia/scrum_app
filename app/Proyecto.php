<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

		public function users(){
		  return $this->belongsToMany("App\User");
		}

		public function historias(){
		  return $this->hasMany("App\Historia");
		}
}
