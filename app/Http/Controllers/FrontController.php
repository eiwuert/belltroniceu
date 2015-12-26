<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
   public function simcard(){
        $user =  \Auth::User();
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
        return view('/simcard', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores));
   }
   
   public function home(){
       $user =  \Auth::User();
       return view('/home', array('user' => $user));
   }
   
   public function settings(){
        $user =  \Auth::User();
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
   
   public function finanzas(){
        $user =  \Auth::User();
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
   }
   
   public function recargas(){
        $user =  \Auth::User();
        $distribuidores = [];
        $subdistribuidores = [];
        $distribuidores = \DB::table('users')->get();
        foreach($distribuidores as $distribuidor){
            $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
        }
        $fechas = \DB::select("select DISTINCT(EXTRACT( YEAR_MONTH FROM fecha_recarga)) fecha  from recargas");
        return view('/recargas', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores, 'fechas' => $fechas));
   }
   
   public function cartera(){
        $user =  \Auth::User();
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
   
   public function control_vendedores(){
        $user =  \Auth::User();
        
        $nombres = \DB::select("select distinct(nombre) from asesores inner join control_vendedores on asesores.cedula = control_vendedores.cedula");
        
        
        return view('/controlVendedoresAdmin', array('user' => $user, 'nombres' => $nombres));
   }
}
