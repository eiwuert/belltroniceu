<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simcard extends Model
{
    protected $table = 'simcards';
    protected $primaryKey = 'ICC';
    
    protected $fillable = array('ICC', 'nombre_subdistribuidor', 'numero','fecha_vencimiento', 'fecha_activacion', 'fecha_entrega', 'paquete', 'tipo');
    
    
}
