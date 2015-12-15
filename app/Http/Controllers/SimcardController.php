<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SimcardController extends Controller
{
    
    public function subirArchivo(Request $request){
        $file = $request->file('image');
        if (($gestor = fopen($file, "r")) !== FALSE) {
            $opcion = fgetcsv($gestor, 1000, ",");
            if($opcion[0] == 'AGREGAR'){
                while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                    $fecha_vencimiento = date_create_from_format("d/m/y",$vars[3]);
                    $simc = \DB::table('simcards')->where('numero', '=',$vars[0])->orwhere('ICC', '=',$vars[1])->first();
                    if($simc != null){
                        $sim = \App\Simcard::find($simc->ICC);
                        $sim->delete();
                    }
                    \App\Simcard::create([
                     'numero' => $vars[0],
                     'ICC' => $vars[1],
                     'fecha_vencimiento' => $fecha_vencimiento,
                     'fecha_activacion' =>  null,
                     'nombreSubdistribuidor' => $vars[2],
                     'tipo' => $vars[4],
                     'paquete' => 0,
                     'fecha_entrega' => null
                     ]);
                }
            }else if($opcion[0] == 'ACTIVAR'){
                while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                   $fecha_activacion = date_create_from_format("d/m/y",$vars[1]);
                   $simc = \DB::table('simcards')->where('numero', '=',$vars[0])->first();
                   if($simc == null){
                       $ICC = \DB::table('simcards')->select('ICC')->orderBy(\DB::raw('ICC*1'))->first();
                       $ICC = $ICC->ICC - 1;
                       $fecha_vencimiento = date_add($fecha_activacion,date_interval_create_from_date_string("9 months"));
                       $fecha_activacion = date_create_from_format("d/m/y",$vars[1]);
                       \App\Simcard::create([
                         'numero' => $vars[0],
                         'ICC' => $ICC,
                         'fecha_vencimiento' => $fecha_vencimiento,
                         'fecha_activacion' =>  null,
                         'nombreSubdistribuidor' => 'SIN ASIGNAR',
                         'tipo' => 1,
                         'paquete' => 0,
                         'fecha_entrega' => null
                         ]);
                   }else{
                       $ICC = $simc->ICC;
                   }
                   $sim = \App\Simcard::find($ICC);
                   if($sim->tipo == 1){
                        $fecha_vencimiento = date_add($fecha_activacion,date_interval_create_from_date_string("9 months"));
                   }else{
                       $fecha_vencimiento = date_add($fecha_activacion,date_interval_create_from_date_string("12 months"));
                   }
                   $fecha_activacion = date_create_from_format("d/m/y",$vars[1]);
                   $sim->fecha_activacion = $fecha_activacion;
                   $sim->fecha_vencimiento = $fecha_vencimiento;
                   $sim->save();
                }
            }
            fclose($gestor);
        }
        return \Redirect::route('simcard'); 
    }
       
   public function buscarSimcard(Request $request)
    {
        if($request->ajax()){
            if($request['dato'] != null){
                $simcard = \DB::table('simcards')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->join('users','subdistribuidores.emailDistribuidor','=','users.email')->where('numero', '=', $request['dato'])->orWhere('ICC', '=', $request['dato'])->get();
            }else{
                $simcard = [];
            }
            return $simcard;
        }
    }
    
    public function asignarPaquete(Request $request)
    {
        if($request->ajax()){
           $sim = \DB::table('simcards')->where('numero', '=', $request['dato'])->orWhere('ICC', '=', $request['dato'])->get();
           if($sim != null){
               if($sim[0]->paquete != 0){
                   $sims = \DB::table('simcards')->where('paquete', '=', $sim[0]->paquete)->get();
                   foreach($sims as $simcard){
                       $toModify = $simcard = \App\Simcard::find($simcard->ICC);
                       $toModify->nombreSubdistribuidor = $request['sub'];
                       $toModify->save();
                   }
                   return 1;
               }else{
                   return -2;
               }
           }else{
               return -1;
           }
        }
    }
    public function buscarSimcardLibre(Request $request)
    {
        if($request->ajax()){
            if($request['dato'] != null){
                $simcard = \DB::table('libres')->where('numero', '=', $request['dato'])->get();
            }else{
                $simcard = [];
            }
            return $simcard;
        }
    }
    
    public function actualizarLibre(Request $request)
    {
        if($request->ajax()){
            if($request['dato'] != null){
                $dato = $request['dato']; 
                $simcard = \App\Libre::find($dato[0]);
                $simcard->responsable = $dato[1];
                $simcard->cedula = $dato[2];
                $simcard->telefono = $dato[3];
                $simcard->ciudad_responsable = $dato[4];
                $simcard->barrio_responsable = $dato[5];
                $simcard->fecha_entrega = $dato[6];
                $simcard->fecha_llamada = $dato[7];
                $simcard->detalle_llamada = $dato[8];
                $simcard->direccion_responsable = $dato[9];
                $simcard->save();
                return 1;
            }else{
                $simcard = [];
            }
            return $simcard;
        }
    }
    public function empaquetar(Request $request){
        if($request->ajax()){
            $datos = $request['datos'];
            $paquete = \DB::table('simcards')->select(\DB::raw('max(paquete) as paquete'))->first();
            foreach($datos as $dato){
                $simcard = \DB::table('simcards')->where('numero', '=',$dato)->first();
                $sim = \App\Simcard::find($simcard->ICC);
                $sim->paquete = $paquete->paquete+1;
                $sim->save();
            }
            return '1';
        }
    }
    
    public function datosSimcard(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $year =  date('Y', time());
            $mesActualLabel = date('M', time());
            $mesAnteriorLabel = date('M', strtotime(date('Y-m')." -1 month"));
            $mes2AnteriorLabel = date('M', strtotime(date('Y-m')." -2month"));
            $mes3AnteriorLabel = date('M', strtotime(date('Y-m')." -3month"));
            $mes4AnteriorLabel = date('M', strtotime(date('Y-m')." -4month"));
            $mesActual = date('m', time());
            $mesAnterior = date('m', strtotime(date('Y-m')." -1 month"));
            $mes2Anterior = date('m', strtotime(date('Y-m')." -2month"));
            $mes3Anterior = date('m', strtotime(date('Y-m')." -3month"));
            $mes4Anterior = date('m', strtotime(date('Y-m')." -4month"));
            
            $labelMeses = [$mes4AnteriorLabel,$mes3AnteriorLabel,$mes2AnteriorLabel, $mesAnteriorLabel,$mesActualLabel];
            $sims = \DB::select("SELECT 
                count(case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) hoyActivas, 
                count( case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) mesAntesActivas, 
                count( case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) mes2AntesActivas, 
                count( case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) mes3AntesActivas, 
                count( case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) mes4AntesActivas, 
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) hoyVencidas, 
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) mesAntesVencidas,
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) mes2AntesVencidas,
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) mes3AntesVencidas,
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) mes4AntesVencidas
                FROM simcards sim inner join subdistribuidores sub on sim.nombreSubdistribuidor = sub.nombre inner join users u on sub.emailDistribuidor = u.email where u.email = ? and sim.tipo=1",[$mesActual,$year,$mesAnterior,$year,$mes2Anterior,$year,$mes3Anterior,$year,$mes4Anterior,$year,$mesActual,$year,$mesAnterior,$year,$mes2Anterior,$year,$mes3Anterior,$year,$mes4Anterior,$year,$user->email]);
            
            $simsPrepago = [$sims[0]->mes4AntesActivas,$sims[0]->mes3AntesActivas,$sims[0]->mes2AntesActivas,$sims[0]->mesAntesActivas,$sims[0]->hoyActivas,$sims[0]->mes4AntesVencidas,$sims[0]->mes3AntesVencidas,$sims[0]->mes2AntesVencidas,$sims[0]->mesAntesVencidas,$sims[0]->hoyVencidas];
            
            
            
            //*/
            $response = array($simsPrepago, $labelMeses);
            return $response;;
        }
    }
    
    public function buscarPaquete(Request $request)
    {
        if($request->ajax()){
            $colors = [];
            if($request['dato_paquete'] != null){
                $sim = \DB::table('simcards')->where('numero', '=', $request['dato_paquete'])->orWhere('ICC', '=', $request['dato_paquete'])->get();
                if($sim != null){
                    if($sim[0]->paquete != 0){
                        $simcard = \DB::table('simcards')->select(\DB::raw('DATEDIFF(CURDATE(),fecha_vencimiento) as month'),'numero','fecha_activacion')->where('paquete',$sim[0]->paquete)->get();
                    }else{
                        $simcard = [];
                        $months= [];
                    }
                }else{
                    $simcard = [];
                    $months= [];
                }
            }else{
                $simcard = [];
            }
            
            return view('/simcardsPaquete', array('simcards'=>$simcard));
        }
    }
    
    
}
