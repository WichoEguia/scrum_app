<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Proyecto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'scrum_master'];

		public function users(){
		  return $this->belongsToMany("App\User");
		}

		public function sprints(){
		  return $this->hasMany("App\Sprint");
		}

		public function es_scrum_master(){
		  return $this->scrum_master == Session::get('user_id');
		}
}
