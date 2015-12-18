<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CarteraController extends Controller
{
    public function datos(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $distribuidor = $request['distribuidor'];
            if($user->isAdmin){
                $registros = \DB::select("select * from carteras inner join users on carteras.email = users.email where users.name = ? order by fecha asc", [$distribuidor]);
                $retorno = [];
                $total = 0;
                foreach($registros as $registro){
                    $registro = (array)$registro;
                    $registro['total'] = $registro['cantidad']*$registro['valor_unitario'];
                    $total += $registro['total'];
                    array_push($retorno, $registro);
                }
                return view('carteraRegistros', ['registros' => $retorno, 'total' => $total]);
            }
        }
    }
    
    public function eliminar(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            if($user->isAdmin){
                try{
                    $id = $request['id'];
                    $cartera = \App\Cartera::find($id);
                    $cartera->delete();
                    return 1;
                }catch(Exception $e){
                    return $e;
                }
            }
        }
    }
    
    public function actualizar(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            if($user->isAdmin){
                try{
                    $fecha =  date_create_from_format("Y-m-d",$request['fecha']);
                    if($fecha != false){
                        $id = $request['id'];
                        $cartera = \App\Cartera::find($id);
                        $cartera->fecha = $fecha;
                        $cartera->descripcion = $request['descripcion'];
                        $cartera->cantidad = $request['cantidad'];
                        $cartera->valor_unitario = $request['valor'];
                        $cartera->save();
                        return 1;
                    }else{
                        return -1;
                    }
                }catch(Exception $e){
                    return $e;
                }
            }
        }
    }
}
