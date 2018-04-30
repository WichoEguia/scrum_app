<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'importancia', 'estimacion', 'notas'];

		public function user(){
		  return $this->belongsTo('App\User');
		}

		public function sprint(){
		  return $this->belongsTo("App\Sprint");
		}
}
