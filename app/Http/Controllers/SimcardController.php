<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SimcardController extends Controller
{
     public function descargarProximasVencer(Request $request)
    {
        if($request->ajax()){
            $datos = \DB::select("select users.name, simcards.numero, simcards.fecha_vencimiento, datediff(simcards.fecha_vencimiento,curdate()) diferencia from simcards inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where datediff(simcards.fecha_vencimiento,curdate()) < 90 and datediff(simcards.fecha_vencimiento,curdate()) > 0 and simcards.fecha_activacion is not null order by datediff(simcards.fecha_vencimiento,curdate())");
            $myfile = fopen("temp/simcardsVencer.csv", "w");
            foreach($datos as $registro){
                fwrite($myfile, $registro->name . ";" . $registro->numero . ";" . $registro->fecha_vencimiento . ";" . $registro->diferencia . "\n");
            }
            fclose($myfile);
            return 1;
        }
    }
    public function subirArchivo(Request $request){
        $action = $request['accion'];
        if($action == "ADD"){
            $file = $request->file('image');
            if(!file_exists($file)) {
                die("File not found. Make sure you specified the correct path.");
            }
            try {
                $pdo = \DB::connection()->getPdo();
            } catch (PDOException $e) {
                die("database connection failed: ".$e->getMessage());
            }
            $columns = '(numero,ICC,fecha_vencimiento,tipo,nombreSubdistribuidor)';
            $affectedRows = $pdo->exec("
                LOAD DATA LOCAL INFILE ".$pdo->quote($file)." INTO TABLE `simcards`
                  FIELDS TERMINATED BY ".$pdo->quote(";")."
                  LINES TERMINATED BY ".$pdo->quote("\n")."
                  IGNORE 0 LINES ". $columns);
            return \Redirect::route('simcard')->with('result' ,$affectedRows); 
        }else if($action == "UPLOA"){
            $file = $request->file('image');
            if(!file_exists($file)) {
                die("File not found. Make sure you specified the correct path.");
            }
            try {
                $pdo = \DB::connection()->getPdo();
            } catch (PDOException $e) {
                die("database connection failed: ".$e->getMessage());
            }
            $columns = '(numero, fecha_activacion)';
            $affectedRows = $pdo->exec("
                LOAD DATA LOCAL INFILE ".$pdo->quote($file)." INTO TABLE `simcards`
                  FIELDS TERMINATED BY ".$pdo->quote(";")."
                  LINES TERMINATED BY ".$pdo->quote("\n")."
                  IGNORE 0 LINES ". $columns."
                  ON DUPLICATE KEY UPDATE");
            return $affectedRows; //\Redirect::route('simcards'); 
        }
        return \Redirect::route('simcard', ['result' => []]);
    }
       
   public function buscarSimcard(Request $request)
    {
        if($request->ajax()){
            if($request['dato'] != null){
                $simcard = \DB::table('simcards')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->join('users','subdistribuidores.emailDistribuidor','=','users.email')->where('numero', '=', $request['dato'])->orWhere('ICC', '=', $request['dato'])->get();
            }else{
                $simcard = [];
            }
            return $simcard;
        }
    }
    
    public function asignarPaquete(Request $request)
    {
        if($request->ajax()){
           $sim = \DB::table('simcards')->where('numero', '=', $request['dato'])->orWhere('ICC', '=', $request['dato'])->get();
           if($sim != null){
               if($sim[0]->paquete != 0){
                   $sims = \DB::table('simcards')->where('paquete', '=', $sim[0]->paquete)->get();
                   foreach($sims as $simcard){
                       $toModify = $simcard = \App\Simcard::find($simcard->ICC);
                       $toModify->nombreSubdistribuidor = $request['sub'];
                       $toModify->save();
                   }
                   return 1;
               }else{
                   return -2;
               }
           }else{
               return -1;
           }
        }
    }
    
    public function asignarUnidad(Request $request)
    {
        if($request->ajax()){
           try{
                $sim = \App\Simcard::find($request['ICC']);
                if($sim != null){
                    $sim->nombreSubdistribuidor = $request['sub'];
                    $sim->save();
                    return 1;
                }else{
                    return "Sim no encontrada.";
                }
           }catch(Exception $e){
               return $e;
           }
        }
    }
    
    public function buscarSimcardLibre(Request $request)
    {
        if($request->ajax()){
            if($request['dato'] != null){
                $simcard = \DB::table('libres')->where('numero', '=', $request['dato'])->get();
            }else{
                $simcard = [];
            }
            return $simcard;
        }
    }
    
    public function actualizarLibre(Request $request)
    {
        if($request->ajax()){
            if($request['dato'] != null){
                $dato = $request['dato']; 
                $simcard = \App\Libre::find($dato[0]);
                $simcard->responsable = $dato[1];
                $simcard->cedula = $dato[2];
                $simcard->telefono = $dato[3];
                $simcard->ciudad_responsable = $dato[4];
                $simcard->barrio_responsable = $dato[5];
                $simcard->fecha_entrega = $dato[6];
                $simcard->fecha_llamada = $dato[7];
                $simcard->detalle_llamada = $dato[8];
                $simcard->direccion_responsable = $dato[9];
                $simcard->save();
                return 1;
            }else{
                $simcard = [];
            }
            return $simcard;
        }
    }
    public function empaquetar(Request $request){
        if($request->ajax()){
            $datos = $request['datos'];
            $paquete = \DB::table('simcards')->select(\DB::raw('max(paquete) as paquete'))->first();
            foreach($datos as $dato){
                $simcard = \DB::table('simcards')->where('numero', '=',$dato)->first();
                $sim = \App\Simcard::find($simcard->ICC);
                $sim->paquete = $paquete->paquete+1;
                $sim->save();
            }
            return '1';
        }
    }
    
    public function datosSimcard(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $year =  date('Y', time());
            $mesActualLabel = date('M', time());
            $mesAnteriorLabel = date('M', strtotime(date('Y-m')." -1 month"));
            $mes2AnteriorLabel = date('M', strtotime(date('Y-m')." -2month"));
            $mes3AnteriorLabel = date('M', strtotime(date('Y-m')." -3month"));
            $mes4AnteriorLabel = date('M', strtotime(date('Y-m')." -4month"));
            $mesActual = date('m', time());
            $mesAnterior = date('m', strtotime(date('Y-m')." -1 month"));
            $mes2Anterior = date('m', strtotime(date('Y-m')." -2month"));
            $mes3Anterior = date('m', strtotime(date('Y-m')." -3month"));
            $mes4Anterior = date('m', strtotime(date('Y-m')." -4month"));
            
            $labelMeses = [$mes4AnteriorLabel,$mes3AnteriorLabel,$mes2AnteriorLabel, $mesAnteriorLabel,$mesActualLabel];
            $sims = \DB::select("SELECT 
                count(case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) hoyActivas, 
                count( case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) mesAntesActivas, 
                count( case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) mes2AntesActivas, 
                count( case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) mes3AntesActivas, 
                count( case when Month(sim.fecha_activacion) = ? and Year(sim.fecha_activacion) = ? then numero end) mes4AntesActivas, 
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) hoyVencidas, 
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) mesAntesVencidas,
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) mes2AntesVencidas,
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) mes3AntesVencidas,
                count(case when Month(sim.fecha_vencimiento) = ? and Year(sim.fecha_vencimiento) = ? then numero end) mes4AntesVencidas
                FROM simcards sim inner join subdistribuidores sub on sim.nombreSubdistribuidor = sub.nombre inner join users u on sub.emailDistribuidor = u.email where u.email = ? and sim.tipo=1",[$mesActual,$year,$mesAnterior,$year,$mes2Anterior,$year,$mes3Anterior,$year,$mes4Anterior,$year,$mesActual,$year,$mesAnterior,$year,$mes2Anterior,$year,$mes3Anterior,$year,$mes4Anterior,$year,$user->email]);
            
            $simsPrepago = [$sims[0]->mes4AntesActivas,$sims[0]->mes3AntesActivas,$sims[0]->mes2AntesActivas,$sims[0]->mesAntesActivas,$sims[0]->hoyActivas,$sims[0]->mes4AntesVencidas,$sims[0]->mes3AntesVencidas,$sims[0]->mes2AntesVencidas,$sims[0]->mesAntesVencidas,$sims[0]->hoyVencidas];
            
            
            
            //*/
            $response = array($simsPrepago, $labelMeses);
            return $response;;
        }
    }
    
    public function buscarPaquete(Request $request)
    {
        if($request->ajax()){
            $colors = [];
            if($request['dato_paquete'] != null){
                $sim = \DB::table('simcards')->where('numero', '=', $request['dato_paquete'])->orWhere('ICC', '=', $request['dato_paquete'])->get();
                if($sim != null){
                    if($sim[0]->paquete != 0){
                        $simcard = \DB::table('simcards')->select(\DB::raw('DATEDIFF(CURDATE(),fecha_vencimiento) as month'),'numero','fecha_activacion')->where('paquete',$sim[0]->paquete)->get();
                    }else{
                        $simcard = [];
                        $months= [];
                    }
                }else{
                    $simcard = [];
                    $months= [];
                }
            }else{
                $simcard = [];
            }
            
            return view('/simcardsPaquete', array('simcards'=>$simcard));
        }
    }
    
    public function datosAsignaciones(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $fecha_inicial = date_create_from_format("Y-m-d",$request['fecha_inicial']);
            $fecha_final = date_create_from_format("Y-m-d", $request['fecha_final']);
            
            if($request['distribuidor'] == null){
                $datos = \DB::select("select simcards.fecha_entrega,subdistribuidores.nombre, simcards.tipo, count(simcards.numero) cantidad from simcards INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and simcards.fecha_entrega > ? and simcards.fecha_entrega < ? group by simcards.fecha_entrega,subdistribuidores.nombre, simcards.tipo",
                     [$user->name, $fecha_inicial, $fecha_final]);
            }else{
                $datos = \DB::select("select simcards.fecha_entrega,subdistribuidores.nombre, simcards.tipo, count(simcards.numero) cantidad from simcards INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and simcards.fecha_entrega > ? and simcards.fecha_entrega < ? group by simcards.fecha_entrega,subdistribuidores.nombre, simcards.tipo",
                     [$request['distribuidor'], $fecha_inicial, $fecha_final]);
            }
            return $datos;
        }
    }
    
    public function asignaciones(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            if($user->isAdmin){
                $datos = \DB::select("select simcards.fecha_entrega,subdistribuidores.nombre, simcards.tipo, count(simcards.numero) cantidad from simcards INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? group by simcards.fecha_entrega,subdistribuidores.nombre, simcards.tipo",
                     [$request['distribuidor']]);
                     
                $myfile = fopen("temp/asignacionesSimcards.csv", "w");
                $totalPrepago = 0;
                $totalLibre = 0;
                foreach($datos as $dato){
                    fwrite($myfile, $dato->fecha_entrega . "," . $dato->nombre . "," . $dato->tipo . "," . $dato->cantidad . "\n");
                    if($dato->tipo == 1){
                        $totalPrepago+= $dato->cantidad;
                    }else{
                        $totalLibre+= $dato->cantidad;
                    }
                }
                fwrite($myfile, "TOTAL LINEAS:," . ($totalPrepago+$totalLibre) . ",\n");
                fwrite($myfile, "TOTAL PREPAGO:," . $totalPrepago . ",\n");
                fwrite($myfile, "TOTAL LIBRE:," . $totalLibre . ",\n");
                fclose($myfile);
                return 1;
            }
        }
    }
}
