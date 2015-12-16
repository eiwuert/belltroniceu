<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RecargasController extends Controller
{
    public function datosRecargas(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $mes = $request['mes'];
            $distribuidor = $request['distribuidor'];
            $datos = \DB::select("select subdistribuidores.nombre, simcards.tipo, sum(recargas.valor_recarga) valor from recargas inner join simcards on recargas.ICC = simcards.ICC INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and MONTH(recargas.fecha_recarga) = ? group by subdistribuidores.nombre, simcards.tipo",
                     [$distribuidor, $mes]);
            return $datos;
        }
    }
}
