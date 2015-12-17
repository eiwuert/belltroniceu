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
    
    public function simcards(Request $request){
        $mes = $request['mes'];
        try{
            $distribuidor = $request['distribuidor'];
            if($distribuidor == null){
                $simcards = \DB::select("select a.name, a.nombreSubdistribuidor,a.numero, sum(a.valor) valor from (select users.name,simcards.nombreSubdistribuidor,simcards.numero, simcards.fecha_activacion, IFNULL(recargas.valor_recarga,0) valor, recargas.fecha_recarga from simcards left join recargas on simcards.ICC = recargas.ICC inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where ISNULL(simcards.fecha_activacion) = false and MONTH(simcards.fecha_activacion) = ? and YEAR(simcards.fecha_activacion) = ? and simcards.tipo = 1 and (MONTH(fecha_recarga) = ? or ISNULL(fecha_recarga) = true)) a group by a.numero HAVING sum(a.valor) < 3000 order by a.name, a.nombreSubdistribuidor, sum(a.valor) asc",
                             [$mes,'2015',$mes]);
                $total = \DB::select("select count(numero) total from simcards where MONTH(simcards.fecha_activacion) = ? and YEAR(simcards.fecha_activacion) = ? and simcards.tipo = 1", [$mes,'2015']);
            }else{
                $simcards = \DB::select("select a.name, a.nombreSubdistribuidor,a.numero, sum(a.valor) valor from (select users.name,simcards.nombreSubdistribuidor,simcards.numero, simcards.fecha_activacion, IFNULL(recargas.valor_recarga,0) valor, recargas.fecha_recarga from simcards left join recargas on simcards.ICC = recargas.ICC inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where ISNULL(simcards.fecha_activacion) = false and MONTH(simcards.fecha_activacion) = ? and YEAR(simcards.fecha_activacion) = ? and users.name = ? and simcards.tipo = 1 and (MONTH(fecha_recarga) = ? or ISNULL(fecha_recarga) = true)) a group by a.numero order by a.name, a.nombreSubdistribuidor, sum(a.valor) asc",
                             [$mes,'2015', $distribuidor, $mes]);
                $total = \DB::select("select count(numero) total from simcards inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where MONTH(simcards.fecha_activacion) = ? and YEAR(simcards.fecha_activacion) = ? and users.name = ? and simcards.tipo = 1", [$mes,'2015', $distribuidor]);
            }
            if($simcards != null){
                $myfile = fopen("temp/estadoSimcards.csv", "w");
                $distri = $simcards[0]->name;
                $subdistri = $simcards[0]->nombreSubdistribuidor;
                fwrite($myfile, $distri . ",,\n");
                fwrite($myfile, "," . $subdistri . ",\n");
                $cantidad = 0;
                foreach($simcards as $simcard){
                    $cantidad++;
                    if($simcard->name != $distri){
                        $distri = $simcard->name;
                        fwrite($myfile, $distri . ",,\n");
                    }
                    if($simcard->nombreSubdistribuidor != $subdistri){
                        $subdistri = $simcard->nombreSubdistribuidor;
                        fwrite($myfile, "," . $subdistri . ",\n");
                    }
                    fwrite($myfile, "," . $simcard->numero . "," . $simcard->valor . "\n");
                }
                $menos = $total[0]->total - $cantidad;
                fwrite($myfile, ", TOTAL AGENCIA,\n");
                fwrite($myfile, "TOTAL LINEAS:," . $total[0]->total . ",\n");
                fwrite($myfile, "LINEAS CON 3000 O MAS DE 3000:," . $menos . ",\n");
                fwrite($myfile, "LINEAS CON MENOS DE 3000:," . $cantidad . ",\n");
                fclose($myfile);
                return 1;
            }else{
                return "no hay simcards activadas para el mes escogido";
            }
        }catch(Exception $e){
            return $e;
        }
    }
}
