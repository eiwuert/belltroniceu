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
             $resultado = \DB::select("SELECT created_at, latitud, longitud from control_vendedores where cedula = ?", [$request['cedula']]);
             return $resultado;
        }
   }
}
