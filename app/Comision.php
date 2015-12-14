<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = 'comisiones';
    
    protected $fillable = array('ICC', 'valor', 'periodo');
}
