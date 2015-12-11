<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SimcardController extends Controller
{
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
    
    public function datosSimcard(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            //$user =  Auth::User();
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
            $simsVencidasEsteMes = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsVencidasMesAnterior = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsVencidas2MesAnterior =\DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            //------------
            
            $simsPrepago = [$simsActivas2MesAnterior,$simsActivasMesAnterior,$simsActivasEsteMes,$simsVencidas2MesAnterior,$simsVencidasMesAnterior,$simsVencidasEsteMes];
            
            // REVISAR SIMS LIBRES
            // REVISAR SIMS ACTIVAS
            $simsActivasEsteMes = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsActivasMesAnterior = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsActivas2MesAnterior =\DB::table('simcards')->where(\DB::raw('MONTH(fecha_activacion)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_activacion)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();

            // ------------
            
            // REVISAR SIMS VENCIDAS
            $simsVencidasEsteMes = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsVencidasMesAnterior = \DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            
            date_sub($today, date_interval_create_from_date_string('1 month'));
            $simsVencidas2MesAnterior =\DB::table('simcards')->where(\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','2')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();
            //------------
            
            $simsLibre = [$simsActivas2MesAnterior,$simsActivasMesAnterior,$simsActivasEsteMes,$simsVencidas2MesAnterior,$simsVencidasMesAnterior,$simsVencidasEsteMes];
            
            $labelMeses = [$mes2Anterior, $mesAnterior,$mesActual];
            //*/
            // Activas - Vencidas - Disponibles
            //$labelMeses = ['octubre','noviembre','diciembre'];
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
                if($sim[0]->paquete != -1){
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
