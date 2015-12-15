<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\AgregarArchivoComisiones;

class FinanzasController extends Controller
{
    public function agregar(Request $request){
        $file = $request->file('image');
        $destinationPath = 'temp';
        $fileName = 'temporal.csv';
        $url = 'public/' . $destinationPath . '/' . $fileName;
        $file->move($destinationPath, $fileName);
        $this->dispatch(new AgregarArchivoComisiones($url));
        return \Redirect::route('finanzas');  
    }
    
    public function datosSimcard(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();   
        }
     }
}
