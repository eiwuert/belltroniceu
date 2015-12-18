<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ControlController extends Controller
{
   public function registroVendedor(Request $request){
        if($request->ajax()){
            \App\ControlVendedor::create([
                'cedula' => $request['cedula'],
                'latitud' => $request['latitud'],
                'longitud' => $request['longitud']
            ]);
        }
   }
}
