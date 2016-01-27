<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RecargasController extends Controller
{
    public function datosRecargas(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $fecha = $request['fecha'];
            $anho = substr($fecha,0,4)+0;
            $mes = substr($fecha,4,2)+0;
            $distribuidor = $request['distribuidor'];
            if($distribuidor == null)
                $distribuidor = $user->name;
            $datos = \DB::select("select subdistribuidores.nombre, simcards.tipo, sum(recargas.valor_recarga) valor from recargas inner join simcards on recargas.telefono = simcards.numero INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and MONTH(recargas.fecha_recarga) = ? and YEAR(recargas.fecha_recarga) = ? group by subdistribuidores.nombre, simcards.tipo",
                     [$distribuidor, $mes, $anho]);
                     
            return $datos;
        }
    }
    
    public function proyecciones(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            $fecha = $request['fecha'];
            $distribuidor = $request['distribuidor'];
            if(strpos($distribuidor, 'OFICINA') === false){
                $admin = false;
            }else{
                $admin = true;
            }
            $anho = substr($fecha,0,4)+0;
            $mes = substr($fecha,4,2)+0;
            if(checkdate($mes, 31, $anho)){ $totalDias = 31; 
            }else if(checkdate($mes, 30, $anho)){ $totalDias = 30; 
            }else if(checkdate($mes, 29, $anho)){$totalDias = 29; 
            }else if (checkdate($mes, 28, $anho)){$totalDias = 28; 
            }else{$totalDias = 0;}
            if(strrpos($distribuidor,"NOADMINISTRADOR") != false)
                $distribuidor = $user->name;
                
            if(strrpos($distribuidor,"ODOS") != false){
                $datos = \DB::select("select simcards.tipo, sum(recargas.valor_recarga) valor from recargas inner join simcards on recargas.telefono = simcards.numero INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where MONTH(recargas.fecha_recarga) = ? and YEAR(recargas.fecha_recarga) = ? group by simcards.tipo",
                     [$mes, $anho]);
                $datos_prepago = \DB::select("SELECT sum(valor_recarga) valor, max(DISTINCT(DAY(fecha_recarga))) dias FROM `recargas` inner join simcards on recargas.telefono = simcards.numero WHERE MONTH(fecha_recarga) = ? and YEAR(fecha_recarga) = ? and simcards.tipo = 1", [$mes, $anho]);
                
                $datos_libre = \DB::select("SELECT sum(valor_recarga) valor, max(DISTINCT(DAY(fecha_recarga))) dias FROM `recargas` inner join simcards on recargas.telefono = simcards.numero WHERE MONTH(fecha_recarga) = ? and YEAR(fecha_recarga) = ? and simcards.tipo = 2", [$mes, $anho]);
            }else{
                $datos = \DB::select("select simcards.tipo, sum(recargas.valor_recarga) valor from recargas inner join simcards on recargas.telefono = simcards.numero INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and MONTH(recargas.fecha_recarga) = ? and YEAR(recargas.fecha_recarga) = ? group by simcards.tipo",
                     [$distribuidor, $mes, $anho]);
                $datos_prepago = \DB::select("SELECT sum(valor_recarga) valor, max(DISTINCT(DAY(fecha_recarga))) dias FROM `recargas` inner join simcards on recargas.telefono = simcards.numero inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on users.email = subdistribuidores.emailDistribuidor WHERE MONTH(fecha_recarga) = ? and YEAR(fecha_recarga) = ? and simcards.tipo = 1 and users.name = ?", [$mes, $anho,$distribuidor]);
                
                $datos_libre = \DB::select("SELECT sum(valor_recarga) valor, max(DISTINCT(DAY(fecha_recarga))) dias FROM `recargas` inner join simcards on recargas.telefono = simcards.numero inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on users.email = subdistribuidores.emailDistribuidor WHERE MONTH(fecha_recarga) = ? and YEAR(fecha_recarga) = ? and simcards.tipo = 2 and users.name = ?", [$mes, $anho,$distribuidor]);
            }
            $actual_prepago = 0;
            $actual_libre = 0;
            foreach ($datos as $dato){
                if($dato->tipo == 1){
                    $actual_prepago = $dato->valor;
                }else{
                    $actual_libre = $dato->valor;
                }
            }
            if($datos_libre[0]->dias == null){
                if($datos_prepago[0]->dias == null){
                    $dia = 1000000000000000;
                }else{
                    $dia = $datos_prepago[0]->dias;
                }
            }else if($datos_prepago[0]->dias == null){
                    if($datos_libre[0]->dias == null){
                        $dia = 1000000000000000;
                    }else{
                        $dia = $datos_libre[0]->dias;
                    }
            }else{
                if($datos_libre[0]->dias > $datos_prepago[0]->dias){
                    $dia = $datos_libre[0]->dias;
                }else{
                    $dia = $datos_prepago[0]->dias;
                }
            }
            $ultima_fecha = max([$datos_prepago[0]->dias,$datos_libre[0]->dias]);
            $ultima_fecha =  date_create_from_format("d/m/Y",$ultima_fecha."/".$mes."/".$anho);
            $proyeccion_recargas_libre = ($datos_libre[0]->valor/$dia)*($totalDias);
            $proyeccion_recargas_prepago = ($datos_prepago[0]->valor/$dia)*($totalDias);
            
            return [$actual_prepago, $actual_libre, $datos_prepago[0]->valor/$dia, $datos_libre[0]->valor/$dia, $proyeccion_recargas_prepago, $proyeccion_recargas_libre,$ultima_fecha,$admin];
        }
    }
    
    public function simcards(Request $request){
        try{
            $user =  \Auth::User();
            $fecha = $request['fecha'];
            $anho = substr($fecha,0,4)+0;
            $mes = substr($fecha,4,2)+0;
            $distribuidor = $request['distribuidor'];
            if($distribuidor == 'user'){
                $distribuidor = $user->name;
            }
            if($distribuidor == null){
                $simcards = \DB::select("select a.name, a.nombreSubdistribuidor,a.numero, sum(a.valor) valor from (select users.name,simcards.nombreSubdistribuidor,simcards.numero, simcards.fecha_activacion, IFNULL(recargas.valor_recarga,0) valor, recargas.fecha_recarga from simcards left join recargas on simcards.numero = recargas.telefono inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where ISNULL(simcards.fecha_activacion) = false and MONTH(simcards.fecha_activacion) = ? and YEAR(simcards.fecha_activacion) = ? and simcards.tipo = 1 and (MONTH(fecha_recarga) = ? or ISNULL(fecha_recarga) = true)) a group by a.numero HAVING sum(a.valor) < 3000 order by a.name, a.nombreSubdistribuidor, sum(a.valor) asc",
                             [$mes,$anho,$mes]);
                $total = \DB::select("select count(numero) total from simcards where MONTH(simcards.fecha_activacion) = ? and YEAR(simcards.fecha_activacion) = ? and simcards.tipo = 1", [$mes,'2015']);
            }else{
                $simcards = \DB::select("select a.name, a.nombreSubdistribuidor,a.numero, sum(a.valor) valor from (select users.name,simcards.nombreSubdistribuidor,simcards.numero, simcards.fecha_activacion, IFNULL(recargas.valor_recarga,0) valor, recargas.fecha_recarga from simcards left join recargas on simcards.numero = recargas.telefono inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where ISNULL(simcards.fecha_activacion) = false and MONTH(simcards.fecha_activacion) = ? and YEAR(simcards.fecha_activacion) = ? and users.name = ? and simcards.tipo = 1 and (MONTH(fecha_recarga) = ? or ISNULL(fecha_recarga) = true)) a group by a.numero order by a.name, a.nombreSubdistribuidor, sum(a.valor) asc",
                             [$mes,$anho, $distribuidor, $mes]);
                $total = \DB::select("select count(numero) total from simcards inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where MONTH(simcards.fecha_activacion) = ? and YEAR(simcards.fecha_activacion) = ? and users.name = ? and simcards.tipo = 1", [$mes,$anho, $distribuidor]);
            }
            if($simcards != null){
                $myfile = fopen("temp/estadoSimcards.csv", "w");
                $distri = $simcards[0]->name;
                $subdistri = utf8_decode($simcards[0]->nombreSubdistribuidor);
                fwrite($myfile, utf8_decode($distri) . ";;\n");
                fwrite($myfile, ";" . utf8_decode($subdistri) . ";\n");
                $cantidad = 0;
                $sinrecarga = 0;
                foreach($simcards as $simcard){
                    if($simcard->valor < 3000 && $simcard->valor > 0){
                        $cantidad++;
                    }else if($simcard->valor == 0){
                        $sinrecarga++;
                    }
                    if(utf8_decode($simcard->name) != $distri){
                        $distri = utf8_decode($simcard->name);
                        fwrite($myfile, $distri . ";;\n");
                    }
                    if(strpos(utf8_decode($simcard->nombreSubdistribuidor),$subdistri) === false && strpos($subdistri,utf8_decode($simcard->nombreSubdistribuidor)) === false){
                        $subdistri = utf8_decode($simcard->nombreSubdistribuidor);
                        fwrite($myfile, ";" . $subdistri . ";\n");
                    }
                    fwrite($myfile, ";" . $simcard->numero . ";" . $simcard->valor . "\n");
                }
                $mas = $total[0]->total - $cantidad-$sinrecarga;
                fwrite($myfile, "; TOTAL AGENCIA;\n");
                fwrite($myfile, "TOTAL LINEAS:;" . $total[0]->total . ";\n");
                fwrite($myfile, "LINEAS CON 3000 O MAS DE 3000:;" . $mas . ";\n");
                fwrite($myfile, "LINEAS SIN RECARGA:;" . $sinrecarga . ";\n");
                fwrite($myfile, "LINEAS CON MENOS DE 3000:;" . $cantidad . ";\n");
                fclose($myfile);
                return [$total[0]->total, $sinrecarga, $cantidad, $mas];
            }else{
                return -1;
            }
        }catch(Exception $e){
            return $e;
        }
    }
    
    public function descargar_estado(Request $request){
        
        if($request->ajax()){
            try{
                $user =  \Auth::User();
                $fecha = $request['fecha'];
                $anho = substr($fecha,0,4)+0;
                $mes = substr($fecha,4,2)+0;
                $distribuidor = $request['distribuidor'];
                if($distribuidor == null)
                    $distribuidor = $user->name;
                $datos = \DB::select("select subdistribuidores.nombre, simcards.numero, simcards.icc, simcards.fecha_entrega, simcards.fecha_activacion, simcards.tipo, recargas.valor_recarga valor from recargas inner join simcards on recargas.telefono = simcards.numero INNER JOIN subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre INNER JOIN users on subdistribuidores.emailDistribuidor = users.email where users.name = ? and MONTH(recargas.fecha_recarga) = ? and YEAR(recargas.fecha_recarga) = ?",
                         [$distribuidor, $mes, $anho]);
                if($datos != null){
                    $myfile = fopen("temp/estadoRecargas.csv", "w");
                    fwrite($myfile, "Recargas de:  ;" . utf8_decode($distribuidor) . "\n");
                    fwrite($myfile, "SUBDISTRIBUIDOR;NUMERO;ICC;FECHA ENTREGA;FECHA ACTIVACION; TIPO; VALOR\n");
                    foreach($datos as $dato){
                        if($dato->tipo == 1){
                            fwrite($myfile, $dato->nombre . ";" . $dato->numero . ";" . $dato->icc . ";". $dato->fecha_entrega . ";" . $dato->fecha_activacion . ";" . "PREPAGO" . ";" . $dato->valor . ";\n");
                        }else{
                            fwrite($myfile, $dato->nombre . ";" . $dato->numero . ";" . $dato->icc . ";". $dato->fecha_entrega . ";" . $dato->fecha_activacion . ";" . "LIBRE" . ";" . $dato->valor . ";\n");
                        }
                    }
                    fclose($myfile);
                    return 1;
                }else{
                    return -1;
                }
            }catch(Exception $e){
                return $e;
            }
        }
    }
    
    public function borrar(Request $request){
        if($request->ajax()){
            $user =  \Auth::User();
            if($user->isAdmin){
                 $simcards = \DB::select("delete from recargas");
                 return 1;
            }   
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
        $columns = '(telefono, fecha_recarga, valor_recarga)';
        $pdo->exec('SET foreign_key_checks = 0');
        $affectedRows = $pdo->exec("
            LOAD DATA LOCAL INFILE ".$pdo->quote($file)." INTO TABLE `recargas`
              FIELDS TERMINATED BY ".$pdo->quote(";")."
              LINES TERMINATED BY ".$pdo->quote("\n")."
              IGNORE 0 LINES ". $columns."
              SET ID = NULL");
              
        $huerfanas = \DB::select("select distinct(recargas.telefono) from simcards RIGHT join recargas on simcards.numero = recargas.telefono where simcards.numero is null");
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
        return \Redirect::route('recargas')->with('result' ,$affectedRows); 
    }
}
