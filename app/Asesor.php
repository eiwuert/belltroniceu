<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $table = 'asesores';
    protected $primaryKey = 'cedula';
    
    protected $fillable = array('cedula', 'nombre');
}
