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
            $total = \DB::select("SELECT sum(valor) as valor from comisiones inner join simcards on comisiones.ICC = simcards.ICC inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where users.email = ? and comisiones.periodo = ?", [$distri[0]->email, $request['periodo']]);
            $comision = \DB::select("SELECT sum(valor) as valor from comisiones inner join simcards on comisiones.ICC = simcards.ICC where simcards.nombreSubdistribuidor = ? and comisiones.periodo = ?", [$request['nombre'], $request['periodo']]);
            if($total == null){
                $total = 0;
            }else{
                $total = $total[0]->valor;
            }
            if($comision == null){
                $comision = 0;
            }else{
                $comision = $comision[0]->valor;
            }
            return [$total-$comision,$comision-0];
        }
     }
}
