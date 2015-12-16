<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubdistribuidorController extends Controller
{
    public function eliminar(Request $request)
    {
        if($request->ajax()){
            try{
                $subdistribuidor = \App\Subdistribuidor::find($request['nombre']);
                $distribuidor = \DB::select("select users.name distribuidor from simcards inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where subdistribuidores.nombre = ? limit 1", [$subdistribuidor->nombre]);
                $sims = \DB::select("update simcards inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre set nombreSubdistribuidor = ? where subdistribuidores.nombre = ?", [$distribuidor->distribuidor, $subdistribuidor->nombre]);
                $subdistribuidor->delete();
                return 1;
            }catch( Exception $e){
                return $e->getMessage();
            }
        }
    }
    
    public function crear(Request $request)
    {
        if($request->ajax()){
            try{
                $subdistribuidor = \App\Subdistribuidor::find($request['nombre']);
                $email = \DB::select("select * from users where users.name = ?", [$request['distribuidor']]);
                if($subdistribuidor == null){
                    \App\Subdistribuidor::create([
                        'nombre' => $request['nombre'],
                        'emailDistribuidor' => $email[0]->email,
                        'cedula' => null,
                        'telefono' => null,
                        'email' => null
                    ]);
                    return 1;    
                }else{
                    return -1;
                }
            }catch( Exception $e){
                return $e->getMessage();
            }
        }
    }
    
    public function buscarSubdistribuidores(Request $request){
        if($request->ajax()){
            $subdistribuidores = \DB::table('subdistribuidores')->join('users','subdistribuidores.emailDistribuidor','=','users.email')->where('users.name', $request['distribuidor'])->get();
        }
        return view('/subdistribuidoresModal', array('subdistribuidores' => $subdistribuidores));
    }
}
