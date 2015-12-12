<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libre extends Model
{
    protected $table = 'libres';
    protected $primaryKey = 'numero';
    
    protected $fillable = array('numero', 'nombre_empresa', 'direccion_empresa','cod_scl', 'cod_punto','fecha_activacion','valor','plan','responsable','cedula','fecha_entrega','direccion_responsable','ciudad_responsable','barrio_responsable','telefono','detalle_llamada');
    
    
}
