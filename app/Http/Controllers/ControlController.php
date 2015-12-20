<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ControlController extends Controller
{
   public function registroVendedor(Request $request){
        if($request->ajax()){
            \App\ControlVendedor::create([
                'cedula' => $request['cedula'],
                'latitud' => $request['latitud'],
                'longitud' => $request['longitud']
            ]);
        }
   }
   
   public function buscar(Request $request){
        if($request->ajax()){
             $asesor = \DB::select("select cedula from asesores where nombre = ?", [$request['nombre']]);
             $resultado = \DB::select("SELECT DATE_SUB(created_at, INTERVAL 5 HOUR) fecha, latitud, longitud from control_vendedores where cedula = ? order by created_at asc", [$asesor[0]->cedula]);
             return $resultado;
        }
   }
}
