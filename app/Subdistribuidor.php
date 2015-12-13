<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistribuidor extends Model
{
    protected $table = 'subdistribuidores';
    protected $primaryKey = 'nombre';
    
    protected $fillable = ['cedula', 'nombre', 'telefono', 'email', 'emailDistribuidor'];
    
    
}
