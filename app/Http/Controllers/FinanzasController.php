<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\AgregarArchivoComisiones;

class FinanzasController extends Controller
{
    public function agregar(Request $request){
        $file = $request->file('image');
        $destinationPath = 'temp';
        $fileName = 'comisiones.csv';
        $url = $destinationPath . '/' . $fileName;
        $file->move($destinationPath, $fileName);
        return \Redirect::route('finanzas'); 
    }
    
    public function datos_subdistribuidor(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();   
            $distri = \DB::select("SELECT users.email from subdistribuidores inner join users on subdistribuidores.emailDistribuidor = users.email where subdistribuidores.nombre = ?", [$request['nombre']]);
            
            $total = \DB::select("SELECT 
                sum(case when simcards.tipo = 1 then comisiones.valor end) totalPrepago, 
                sum(case when simcards.tipo = 2 then comisiones.valor end) totalLibre
                FROM comisiones inner join simcards on comisiones.ICC = simcards.ICC inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email 
                WHERE users.email = ? and comisiones.periodo = ?", [$distri[0]->email, $request['periodo']]);
            $comision = \DB::select("SELECT 
                sum(case when simcards.tipo = 1 then comisiones.valor end) comisionPrepago, 
                sum( case when simcards.tipo = 2 then comisiones.valor end) comisionLibre
                FROM comisiones inner join simcards on comisiones.ICC = simcards.ICC 
                WHERE simcards.nombreSubdistribuidor = ? and comisiones.periodo = ?", [$request['nombre'], $request['periodo']]);
             
            if($total[0]->totalPrepago == null){
                $totalPrepago = 0;
            }else{
                $totalPrepago = $total[0]->totalPrepago;
            }
            if($total[0]->totalLibre == null){
                $totalLibre = 0;
            }else{
                $totalLibre = $total[0]->totalLibre;
            }
            if($comision[0]->comisionPrepago == null){
                $comisionPrepago = 0;
            }else{
                $comisionPrepago = $comision[0]->comisionPrepago;
            }
            if($comision[0]->comisionLibre == null){
                $comisionLibre = 0;
            }else{
                $comisionLibre = $comision[0]->comisionLibre;
            }
            
            // RETENCIONES
            return [$totalPrepago-0, $totalLibre-0, $comisionPrepago-0, $comisionLibre-0];
        }
     }
     
     public function datosComisiones(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $periodo = $request['periodo'];
            if($request['distribuidor'] == null){
                $datos = \DB::select("select subdistribuidores.nombre, simcards.tipo, sum(comisiones.valor) valor from comisiones inner join simcards on comisiones.ICC = simcards.ICC INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and comisiones.periodo = ? and fecha_vencimiento > curdate() group by subdistribuidores.nombre, simcards.tipo",
                     [$user->name, $periodo]);
            }else{
                $datos = \DB::select("select subdistribuidores.nombre, simcards.tipo, sum(comisiones.valor) valor from comisiones inner join simcards on comisiones.ICC = simcards.ICC INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and comisiones.periodo = ? and fecha_vencimiento > curdate() group by subdistribuidores.nombre, simcards.tipo",
                     [$request['distribuidor'], $periodo]);
            }
            return $datos;
        }
    }
}
