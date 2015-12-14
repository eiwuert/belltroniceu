<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinanzasController extends Controller
{
    public function agregar(Request $request){
        $file = $request->file('image');
        if (($gestor = fopen($file, "r")) !== FALSE) {
            while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
               $numero = str_replace('"', '',$vars[12]);
               $periodo = str_replace('"', '',$vars[27]);
               try{
                    $simc = \DB::table('simcards')->where('numero', '=',$numero)->first();
                    if($simc == null){
                        $ICC = \DB::table('simcards')->select(\DB::raw('min(ICC) as ICC'))->first();
                        $ICC = $ICC->ICC - 1;
                        \App\Simcard::create([
                         'ICC' => $ICC,
                         'numero' => $numero,
                         'fecha_vencimiento' => null,
                         'fecha_activacion' =>  null,
                         'nombreSubdistribuidor' => 'SIN ASIGNAR',
                         'tipo' => 1,
                         'paquete' => 0,
                         'fecha_entrega' => null
                         ]);
                    }
                    \App\Comision::create([
                             'ICC' => $simc->ICC,
                             'valor' => $vars[25],
                             'periodo' => $periodo,
                             ]);   
               }catch(Exception $e){
                   return $e;
               }
            }
            fclose($gestor);
        }
        return \Redirect::route('finanzas');  
    }
    
    public function datosSimcard(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();   
        }
     }
}
