<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historia extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'importancia', 'estimacion', 'notas'];
}
