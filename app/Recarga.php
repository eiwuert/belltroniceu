<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recarga extends Model
{
    protected $table = 'recargas';
    
    protected $fillable = array('ICC', 'fecha_recarga', 'valor_recarga');
}
