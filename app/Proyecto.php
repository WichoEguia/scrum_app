<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

		public function users(){
		  return $this->belongsToMany("App\User");
		}

		public function sprints(){
		  return $this->hasMany("App\Sprint");
		}
}
