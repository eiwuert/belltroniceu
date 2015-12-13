<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SimcardController extends Controller
{
    
   public function agregar(Request $request){
       if($request->ajax()){
           try{
               $today = new \DateTime('today');
               $dato = $request['dato'];
               $vars = explode(",",$dato);
               $fecha_vencimiento = date_create_from_format("d/m/y",$vars[4]);
                \App\Simcard::create([
                     'numero' => $vars[0],
                     'ICC' => $vars[1],
                     'fecha_vencimiento' => $fecha_vencimiento,
                     'fecha_activacion' =>  null,
                     'nombreSubdistribuidor' => $vars[3],
                     'tipo' => $vars[5],
                     'paquete' => 0,
                     'fecha_entrega' => $today
                     ]);   
                     return 1;
           }catch(Exception $e){
               return $e;
           }
       }
   }
   public function activar(Request $request){
       if($request->ajax()){
           try{
               $dato = $request['dato'];
               $vars = explode(",",$dato);
               $fecha_activacion = date_create_from_format("d/m/y",$vars[1]);
               $simc = \DB::table('simcards')->where('numero', '=',$vars[0])->orwhere('ICC', '=',$vars[0])->first();
               $sim = \App\Simcard::find($simc->ICC);
               if($sim->tipo == 1){
                    $fecha_vencimiento = date_add($fecha_activacion,date_interval_create_from_date_string("9 months"));
               }else{
                   $fecha_vencimiento = date_add($fecha_activacion,date_interval_create_from_date_string("12 months"));
               }
               $fecha_activacion = date_create_from_format("d/m/y",$vars[1]);
               $sim->fecha_activacion = $fecha_activacion;
               $sim->fecha_vencimiento = $fecha_vencimiento;
               $sim->save();
               return 1;
           }catch(Exception $e){
               return $e;
           }
       }
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
            $today = new \DateTime('today');
            
            // REVISAR SIMS PREPAGO
            // REVISAR SIMS ACTIVAS
            $simsActivasEsteMes = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            $mesActual = $today->format('F');
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsActivasMesAnterior = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            $mesAnterior = $today->format('F');
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsActivas2MesAnterior =\DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            $mes2Anterior = $today->format('F');
            // ------------
            
            // REVISAR SIMS VENCIDAS
            $today = new \DateTime('today');
            $simsVencidasEsteMes = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),'=',$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),'=',$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsVencidasMesAnterior = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),'=',$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),'=',$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsVencidas2MesAnterior =\DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            //------------
            
            $simsPrepago = [$simsActivas2MesAnterior,$simsActivasMesAnterior,$simsActivasEsteMes,$simsVencidas2MesAnterior,$simsVencidasMesAnterior,$simsVencidasEsteMes];
            
            // REVISAR SIMS LIBRES
            // REVISAR SIMS ACTIVAS
            $today = new \DateTime('today');
            $simsActivasEsteMes = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsActivasMesAnterior = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsActivas2MesAnterior =\DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();

            // ------------
            
            // REVISAR SIMS VENCIDAS
            $today = new \DateTime('today');
            $simsVencidasEsteMes = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsVencidasMesAnterior = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsVencidas2MesAnterior =\DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            //------------
            
            $simsLibre = [$simsActivas2MesAnterior,$simsActivasMesAnterior,$simsActivasEsteMes,$simsVencidas2MesAnterior,$simsVencidasMesAnterior,$simsVencidasEsteMes];
            
            $labelMeses = [$mes2Anterior, $mesAnterior,$mesActual];
            //*/
            $response = array($simsPrepago, $simsLibre, $labelMeses);
            return $response;;
        }
    }
    
    public function buscarPaquete(Request $request)
    {
        if($request->ajax()){
            $colors = [];
            if($request['dato_paquete'] != null){
                $sim = \DB::table('simcards')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->join('users','subdistribuidores.emailDistribuidor','=','users.email')->where('numero', '=', $request['dato_paquete'])->orWhere('ICC', '=', $request['dato_paquete'])->get();
                if($sim != null){
                    if($sim[0]->paquete != 0){
                        $simcard = \DB::table('simcards')->where('paquete',$sim[0]->paquete)->get();
                        $months = \DB::table('simcards')->select(\DB::raw('DATEDIFF(CURDATE(),fecha_vencimiento) as month'))->where('paquete',$sim[0]->paquete)->get(); 
                        $i = 0;
                        foreach($months as $month){
                            if($simcard[$i]->fecha_activacion != null){
                                if($month->month <= 0){
                                    array_push($colors,'green');
                                }else{
                                    array_push($colors,'red');
                                }
                            }else{
                                if($month->month <= 0){
                                    array_push($colors,'blue');
                                }else{
                                    array_push($colors,'red');
                                }
                            }
                            $i++;
                        }
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
            
                
            return view('/simcardsPaquete', array('simcards'=>$simcard, 'colors' => $colors));
        }
    }
    
    public function buscarSubdistribuidores(Request $request){
        if($request->ajax()){
            $subdistribuidores = \DB::table('subdistribuidores')->join('users','subdistribuidores.emailDistribuidor','=','users.email')->where('users.name', $request['distribuidor'])->get();
        }
        return view('/subdistribuidoresModal', array('subdistribuidores' => $subdistribuidores));
    }
}
