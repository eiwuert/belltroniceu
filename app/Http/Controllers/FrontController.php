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
}
