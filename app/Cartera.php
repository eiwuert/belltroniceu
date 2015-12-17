<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    protected $table = 'carteras';
    
    protected $fillable = array('email', 'fecha', 'descripcion','cantidad','valor_unitario');
}
