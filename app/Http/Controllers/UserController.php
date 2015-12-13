<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

class UserController extends Controller
{
    
    public function actualizar(Request $request)
    {
        if($request->ajax()){
            $email = $request['email'];
            $password = $request['password'];
            $new_password = $request['new_password'];
            $user =  \Auth::User();
            $updated = false;
            if (Hash::check($password, $user->password)){
                $aux = \App\User::find($email);
                if($aux != null){
                    $user->email = $email;
                    $updated = true;
                }else{
                    return -2;
                } 
                if($new_password != ''){
                    $user->password = bcrypt($new_password);
                }
                $user->save();
                return 1;
            }else{
                return -1;
            }
        }
    }
    
    public function crear(Request $request){
        if($request->ajax()){
            $name = $request['name'];
            $email = $request['email'];
            $password = $request['password'];
            if($request['admin'] == 1){
                $admin = 1;
            }else{
                $admin = 0;
            }
            $aux = \App\User::find($email);
            if($aux == null){
                $subdistri = \App\Subdistribuidor::find($name);
                if($subdistri == null){
                    try{
                        \App\User::create([
                                        'name' => $name,
                                        'email' => $email,
                                        'isAdmin' => $admin,
                                        'password' => bcrypt($request['password']),
                                    ]);
                        \App\Subdistribuidor::create([
                                                     'cedula' => '-',
                                                     'nombre' => $name,
                                                     'telefono' => '-',
                                                     'email' => '-',
                                                     'emailDistribuidor' => $email,
                                                     ]);
                        return 1;
                    }catch(Exception $e){
                        return $e;
                    }
                }else{
                    return -2;
                }
            }else{
                return -1;
            }
        }
    }
}
