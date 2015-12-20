<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Mail\Mailer;
use Mail;

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
                if($aux == null || $aux->email == $user->email){
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
                                        'password' => bcrypt('password'),
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
    
    public function eliminar(Request $request)
    {
        if($request->ajax()){
            try{
                $aux = \DB::table('users')->where('users.name','=',$request['nombre'])->first();
                $user = \App\User::find($aux->email);
                $sims = \DB::select("update simcards inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre set nombreSubdistribuidor = 'SIN ASIGNAR' where subdistribuidores.emailDistribuidor = ?", [$user->email]);
                $subs = \DB::select("delete from subdistribuidores where subdistribuidores.emailDistribuidor = ?", [$user->email]);
                $user->delete();
                return 1;
            }catch( Exception $e){
                return $e->getMessage();
            }
        }
    }
    
     public function postReset(Request $request)
    {
        try{
            $email = $request['email'];
            $user = \App\User::find($email);
            if($user != null){
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < 10; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $user->password = bcrypt($randomString);
                $user->save();
                Mail::send('emails.passwordReminder', ['password' => $randomString], function ($m) use ($user) {
                    $m->from('belltronic1@gmail.com', 'TU PORTAL');
                    $m->to($user->email, $user->name)->subject('RESET DE CONTRASEÑA');
                });
                return view('auth/login');
            }else{
                return view('auth/login');
            }
        }catch( Exception $e){
            return $e->getMessage();
        }
    }
}
