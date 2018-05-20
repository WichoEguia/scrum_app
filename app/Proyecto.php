<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Proyecto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'scrum_master'];

		/**
		 * Establece relacion proyecto pertenece a varios usuarios
		 *
		 * Establece relacion proyecto pertenece a varios usuarios
		*/
		public function users(){
		  return $this->belongsToMany("App\User");
		}

		/**
		 * Establece relacion proyecto tiene varios sprints
		 *
		 * Establece relacion proyecto tiene varios sprints
		*/
		public function sprints(){
		  return $this->hasMany("App\Sprint");
		}

		/**
		 * es_scrum_master
		 *
		 * Regresa booleano para identificar si
		 * el usuario de la sesion actual es scrum master
		 *
		 * @return Boolean
		*/
		public function es_scrum_master(){
		  return $this->scrum_master == Session::get('user_id');
		}
}
