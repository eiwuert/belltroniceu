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
        $periodos = \DB::select("select distinct periodo from comisiones");
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
        $meses = \DB::select("select distinct MONTH(fecha_recarga) mes from recargas");
        return view('/recargas', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores, 'meses' => $meses));
   }
   
   public function cartera(){
        $user =  \Auth::User();
        $distribuidores = [];
        $subdistribuidores = [];
        if($user->isAdmin){
            $distribuidores = \DB::table('users')->get();
            foreach($distribuidores as $distribuidor){
                $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
            }
            $registros = \DB::select("select * from carteras where email = ? order by fecha asc", [$user->email]);
        }else{
            $subdistribuidores = \DB::table('subdistribuidores')->where('emailDistribuidor', $user->email)->get();
            $registros = \DB::select("select * from carteras where email = ? order by fecha asc", [$user->email]);
        }
        
        $retorno = [];
        $total = 0;
        foreach($registros as $registro){
            $registro = (array)$registro;
            $registro['total' ] = $registro['cantidad']*$registro['valor_unitario'];
            if($registro['deuda'] == true){
                $total -= $registro['total'];
            }else{
                $total += $registro['total'];
            }
            $total = number_format($total, 0, ',', ',');
            $registro['total'] = number_format($registro['total'], 0, ',', ',');
            $registro['valor_unitario'] = number_format($registro['valor_unitario'], 0, ',', ',');
            array_push($retorno, $registro);
        }
        return view('/cartera', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores, 'retorno' => $retorno, 'total' => $total));
   }
}
