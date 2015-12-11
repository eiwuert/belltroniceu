<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libre extends Model
{
    protected $table = 'libres';
    protected $primaryKey = 'numero';
    
    protected $fillable = array('numero', 'nombre_empresa', 'nit','valor', 'plan');
    
    
}
