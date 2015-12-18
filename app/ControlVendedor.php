<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlVendedor extends Model
{
    protected $table = 'control_vendedores';
    
    protected $fillable = array('fecha', 'cedula', 'latitud', 'longitud');
}
