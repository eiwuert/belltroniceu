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
}
