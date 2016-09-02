<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Simcard;
use DB;
class FrontController extends Controller
{
   public function simcard(){
        $user =  \Auth::User();
        if(!$user->isContabilidad){
            $distribuidores = [];
            $subdistribuidores = [];
            $distribuidores = \DB::table('users')->get();
            foreach($distribuidores as $distribuidor){
                $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
            }
            return view('/simcard', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores));
        }
   }
   
   public function home(){
       $user =  \Auth::User();
       return view('/home', array('user' => $user));
   }
   
   public function settings(){
        $user =  \Auth::User();
        if(!$user->isContabilidad){
            $distribuidores = [];
            $subdistribuidores = [];
            if($user->isAdmin){
                $distribuidores = \DB::table('users')->get();
                foreach($distribuidores as $distribuidor){
                    $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
                }
            }else{
                $subdistribuidores = \DB::table('subdistribuidores')->where('emailDistribuidor', $user->email)->get();
            }
           return view('/settings', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores));
        }
   }
   
   public function finanzas(){
        $user =  \Auth::User();
        $now = new \DateTime();
        $lasth_month = date_add($now,date_interval_create_from_date_string("-1 months"));
        $now = new \DateTime();
        $last_last_month = date_add($now,date_interval_create_from_date_string("-2 months"));
        $now = new \DateTime();
        //\DB::select("delete from comisiones where periodo <> extract(year_month from ?) and periodo <> extract(year_month from ?) and periodo <> extract(year_month from ?)", [$now, $lasth_month, $last_last_month]);
        if(!$user->isContabilidad){
            $distribuidores = [];
            $subdistribuidores = [];
            if($user->isAdmin){
                $distribuidores = \DB::table('users')->get();
                foreach($distribuidores as $distribuidor){
                    $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
                }
            }else{
                $subdistribuidores = \DB::table('subdistribuidores')->where('emailDistribuidor', $user->email)->get();
            }
            $periodos = \DB::select("select distinct periodo from comisiones order by periodo desc");
            return view('/finanzas', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores, 'periodos' => $periodos));
        }else{
            $distribuidores = \DB::table('users')->where('name', '<>','OFICINA')->get();
            foreach($distribuidores as $distribuidor){
                $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
            }
            $periodos = \DB::select("select distinct periodo from comisiones order by periodo desc");
            return view('/finanzas', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores, 'periodos' => $periodos));
        }
   }
   
    public function recargas(){
        $user =  \Auth::User();
        if(!$user->isContabilidad){
            $distribuidores = [];
            $subdistribuidores = [];
            $distribuidores = \DB::table('users')->get();
            foreach($distribuidores as $distribuidor){
                $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
            }
            $fechas = \DB::select("select DISTINCT(EXTRACT( YEAR_MONTH FROM fecha_recarga)) fecha  from recargas order by fecha desc");
            return view('/recargas', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores, 'fechas' => $fechas));
        }
   }
   
    public function cartera(){
        $user =  \Auth::User();
        if(!$user->isContabilidad){
            $distribuidores = [];
            $subdistribuidores = [];
            $comisiones = 0;
            if($user->isAdmin){
                $distribuidores = \DB::table('users')->get();
                foreach($distribuidores as $distribuidor){
                    $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
                }
                $registros = \DB::select("select * from carteras where email = ? order by fecha asc", [$user->email]);
            }else{
                $subdistribuidores = \DB::table('subdistribuidores')->where('emailDistribuidor', $user->email)->get();
                $registros = \DB::select("select * from carteras where email = ? order by fecha asc", [$user->email]);
                $comisiones = \DB::select("select sum(valor_unitario*cantidad) comisiones from carteras where email = ? and valor_unitario > 0 order by fecha asc", [$user->email]);
                $comisiones = $comisiones[0]->comisiones;
            }
            
            $retorno = [];
            $total = 0;
            foreach($registros as $registro){
                $registro = (array)$registro;
                $registro['total'] = $registro['cantidad']*$registro['valor_unitario'];
                $total += $registro['total'];
                array_push($retorno, $registro);
            }
            
            return view('/cartera', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores, 'retorno' => $retorno, 'total' => $total, 'comisiones' => $comisiones));
        }
   }
   
   public function control_vendedores(){
        $user =  \Auth::User();
        if(!$user->isContabilidad){
            $nombres = \DB::select("select distinct(nombre) from asesores inner join control_vendedores on asesores.cedula = control_vendedores.cedula");
            
            
            return view('/controlVendedoresAdmin', array('user' => $user, 'nombres' => $nombres));
        }
   }
}
