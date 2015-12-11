<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simcard extends Model
{
    protected $table = 'simcards';
    protected $primaryKey = 'ICC';
    
    protected $fillable = array('ICC', 'nombreSubdistribuidor', 'numero','fecha_vencimiento', 'fecha_activacion', 'paquete', 'tipo');
    
    
}
