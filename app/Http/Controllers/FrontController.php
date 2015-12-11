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
        }else{
            array_push($distribuidores,$user);
        }
        foreach($distribuidores as $distribuidor){
            $subdistribuidores[$distribuidor->name] = \DB::table('subdistribuidores')->where('emailDistribuidor', $distribuidor->email)->get();
        }
        
        return view('/simcard', array('user' => $user, 'subdistribuidores'=>$subdistribuidores, 'distribuidores' => $distribuidores));
   }
}
