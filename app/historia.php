<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'importancia', 'estimacion', 'notas'];

		public function proyecto(){
		  $this->belongsTo("App\Proyecto");
		}
}
