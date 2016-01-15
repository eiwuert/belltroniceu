<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ControlController extends Controller
{
   public function registroVendedor(Request $request){
        if($request->ajax()){
            $asesor = \App\Asesor::find($request['cedula']);
            if($asesor != null){
                \App\ControlVendedor::create([
                    'cedula' => $request['cedula'],
                    'latitud' => $request['latitud'],
                    'longitud' => $request['longitud']
                ]);
                return 1;
            }else{
                return -1;
            }
        }
   }
   
   public function buscar(Request $request){
        if($request->ajax()){
             $asesor = \DB::select("select cedula from asesores where nombre = ?", [$request['nombre']]);
             $resultado = \DB::select('SELECT date_format(created_at, "%b %d %Y %h:%i %p") fecha, latitud, longitud from control_vendedores where cedula = ? order by created_at desc', [$asesor[0]->cedula]);
             return $resultado;
        }
   }
   
   public function eliminar(Request $request){
        if($request->ajax()){
             try{
                \DB::select("delete from asesores where nombre = ?", [$request['nombre']]);
                return 1;
             }catch(Exception $e){
                 return $e;
             }
        }
   }
   
    public function crearAsesor(Request $request)
    {
        if($request->ajax()){
            try{
                $asesor = \App\Asesor::find($request['cedula']);
                if($asesor == null){
                    $asesor = \DB::select("select * from asesores where nombre = ?", [$request['nombre']]);
                    if(sizeof($asesor) == 0){
                        \App\Asesor::create([
                            'nombre' => $request['nombre'],
                            'cedula' => $request['cedula'],
                        ]);
                        return 1;    
                    }else{
                        return -2;
                    }
                }else{
                    return -1;
                }
            }catch( Exception $e){
                return $e->getMessage();
            }
        }
    }
}
