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
        $fileName = 'comisiones.csv';
        $url = $destinationPath . '/' . $fileName;
        $file->move($destinationPath, $fileName);
        return \Redirect::route('finanzas'); 
    }
    
    public function descargar(Request $request)
    {
        if($request->ajax()){
            $user =  \Auth::User();
            $distribuidor = $request['distribuidor'];
            $periodo = $request['periodo'];
            $datosSubs = [];
            $datos = \DB::select("select subdistribuidores.nombre, simcards.tipo, comisiones.valor valor from comisiones inner join simcards on comisiones.telefono = simcards.numero INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and comisiones.periodo = ? and EXTRACT(YEAR_MONTH FROM fecha_vencimiento) >= ?",
                     [$request['distribuidor'], $periodo,$periodo]);
            $myfile = fopen("temp/datosComisiones.csv", "w");
            fwrite($myfile, "DATOS DE COMISIONES DE " . $distribuidor . "\n");
            fwrite($myfile, "PERSONA;TIPO;VALOR\n");
            foreach($datos as $registro){
                fwrite($myfile, utf8_decode($registro->nombre) . ";" . $registro->tipo . ";" . $registro->valor . "\n");
            }
            fclose($myfile);
            return 1;
        }
    }
    
    public function datos_subdistribuidor(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();   
            $distri = \DB::select("SELECT users.email from subdistribuidores inner join users on subdistribuidores.emailDistribuidor = users.email where subdistribuidores.nombre = ?", [$request['nombre']]);
            
            $total = \DB::select("SELECT 
                sum(case when simcards.tipo = 1 then comisiones.valor end) totalPrepago, 
                sum(case when simcards.tipo = 2 then comisiones.valor end) totalLibre
                FROM comisiones inner join simcards on comisiones.telefono = simcards.numero inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email 
                WHERE users.email = ? and comisiones.periodo = ?", [$distri[0]->email, $request['periodo']]);
            $comision = \DB::select("SELECT 
                sum(case when simcards.tipo = 1 then comisiones.valor end) comisionPrepago, 
                sum( case when simcards.tipo = 2 then comisiones.valor end) comisionLibre
                FROM comisiones inner join simcards on comisiones.telefono = simcards.numero 
                WHERE simcards.nombreSubdistribuidor = ? and comisiones.periodo = ?", [$request['nombre'], $request['periodo']]);
             
            if($total[0]->totalPrepago == null){
                $totalPrepago = 0;
            }else{
                $totalPrepago = $total[0]->totalPrepago;
            }
            if($total[0]->totalLibre == null){
                $totalLibre = 0;
            }else{
                $totalLibre = $total[0]->totalLibre;
            }
            if($comision[0]->comisionPrepago == null){
                $comisionPrepago = 0;
            }else{
                $comisionPrepago = $comision[0]->comisionPrepago;
            }
            if($comision[0]->comisionLibre == null){
                $comisionLibre = 0;
            }else{
                $comisionLibre = $comision[0]->comisionLibre;
            }
            
            // RETENCIONES
            return [$totalPrepago-0, $totalLibre-0, $comisionPrepago-0, $comisionLibre-0];
        }
     }
     
     public function datosComisiones(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $periodo = $request['periodo'];
            $datosSubs = [];
            if($request['distribuidor'] == null){
                $datos = \DB::select("select subdistribuidores.nombre, simcards.tipo, sum(comisiones.valor) valor from comisiones inner join simcards on comisiones.telefono = simcards.numero INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and comisiones.periodo = ? and EXTRACT(YEAR_MONTH FROM fecha_vencimiento) >= ? group by subdistribuidores.nombre, simcards.tipo",
                     [$user->name, $periodo,$periodo]);
                 $admin = false;
            }else{
                $datos = \DB::select("select subdistribuidores.nombre, simcards.tipo, sum(comisiones.valor) valor from comisiones inner join simcards on comisiones.telefono = simcards.numero INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and comisiones.periodo = ? and EXTRACT(YEAR_MONTH FROM fecha_vencimiento) >= ? group by subdistribuidores.nombre, simcards.tipo",
                     [$request['distribuidor'], $periodo,$periodo]);
                 if(strrpos($request['distribuidor'],'OFICINA') === false){
                     $datosSubs = [];
                     $admin = false;
                 }else{
                     $admin = true;
                     $datosSubs = \DB::select("select simcards.tipo,sum(comisiones.valor) valor from comisiones inner join simcards on comisiones.telefono = simcards.numero INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name <> 'OFICINA' and comisiones.periodo = ? and EXTRACT(YEAR_MONTH FROM fecha_vencimiento) >= ? group by simcards.tipo",
                         [$periodo,$periodo]);
                 }
            }
            return [$datos, $admin, $datosSubs];
        }
    }
    
    public function subirArchivo(Request $request){
        $file = $request->file('image');
        if(!file_exists($file)) {
            die("File not found. Make sure you specified the correct path.");
        }
        try {
            $pdo = \DB::connection()->getPdo();
        } catch (PDOException $e) {
            die("database connection failed: ".$e->getMessage());
        }
        $columns = '(telefono, periodo, valor)';
        $pdo->exec('SET foreign_key_checks = 0');
        $affectedRows = $pdo->exec("
            LOAD DATA LOCAL INFILE ".$pdo->quote($file)." INTO TABLE `comisiones`
              FIELDS TERMINATED BY ".$pdo->quote(";")."
              LINES TERMINATED BY ".$pdo->quote("\n")."
              IGNORE 0 LINES ". $columns."
              SET ID = NULL");
              
        $huerfanas = \DB::select("select distinct(comisiones.telefono) from simcards RIGHT join comisiones on simcards.numero = comisiones.telefono where simcards.numero is null");
        $ICC = \DB::table('simcards')->select('ICC')->orderBy(\DB::raw('ICC*1'))->first();
        $ICC = $ICC->ICC;
        $fecha_vencimiento = date_add(new \DateTime(),date_interval_create_from_date_string("6 months"));
        foreach($huerfanas as $huerfana){
            $ICC = $ICC - 1;
            try{
                \App\Simcard::create([
                     'numero' => $huerfana->telefono,
                     'ICC' => $ICC,
                     'fecha_vencimiento' => $fecha_vencimiento,
                     'fecha_activacion' =>  null,
                     'nombreSubdistribuidor' => 'SIN ASIGNAR',
                     'tipo' => 1,
                     'paquete' => 0,
                     'fecha_entrega' => null
                     ]);
            }catch(Exception $e){}
        }
        $pdo->exec('SET foreign_key_checks = 1');
        return \Redirect::route('finanzas')->with('result' ,$affectedRows); 
    }
    
    public function borrar(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            if($user->isAdmin){
                 \DB::select("delete from comisiones");
                 return 1;
            }   
        }
    }
}
