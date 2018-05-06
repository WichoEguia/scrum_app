<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notificacion;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'userphoto'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

		public function proyectos(){
		  return $this->belongsToMany("App\Proyecto");
		}

		public function historias(){
		  return $this->hasMany('App\Historia');
		}

		public function notificaciones(){
		  return $this->hasMany('App\Notificacion');
		}

		public function numero_notificaciones(){
		  $numero_notificaciones = count($this->notificaciones->where('estatus', 'no_leido'));
			return $numero_notificaciones > 9 ? "+9" : $numero_notificaciones;
		}
}
