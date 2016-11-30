<?php

use Illuminate\Database\Seeder;

class agregarComisionesSeeder extends Seeder
{
    /**
     * Run the database seeds. 
     *
     * @return void
     */
    public function run()
    {
        /* Actualizar valores de planes */
        //*
        $planMM = \DB::table('libres')->where("plan","MM")->update(["valor"=>"57100"]);
        $this->command->info("Actualizadas MM: " . $planMM);
        $plan1E = \DB::table('libres')->where("plan","1E")->update(["valor"=>"76900"]);
        $this->command->info("Actualizadas 1E: " . $plan1E);
        $plan1L = \DB::table('libres')->where("plan","1L")->update(["valor"=>"94500"]);
        $this->command->info("Actualizadas 1L: " . $plan1L);
        $planPM = \DB::table('libres')->where("plan","PM")->update(["valor"=>"32100"]);
        $this->command->info("Actualizadas PM: " . $planPM);
        //*/
        /*
        $this->command->info('Subir archivo libres...');
        if (file_exists('public/temp/libres.csv')) {
            if (($gestor = fopen('public/temp/libres.csv', "r")) !== FALSE) {
                $i = 0;
                while (($vars = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                   $numero = $vars[0];
                   $codigo = $vars[1];
                   $fecha = $vars[2];
                   $sim = \App\Libre::find($numero);
                   if($sim != null){
                    $sim->fecha_activacion = $fecha;
                    $sim->plan = $codigo;
                    $sim->save();
                   }
                   $sim = \App\Simcard::find($numero);
                   if($sim != null){
                    $sim->fecha_activacion = $fecha;
                    $sim->save();
                   }
                }
                fclose($gestor);
                unlink('public/temp/libres.csv');
                $this->command->info('modificados: ' . $i);
            }
        }
        */
        /*
        $this->command->info('Subir archivo comisiones...');
        if (file_exists('public/temp/comisiones.csv')) {
            if (($gestor = fopen('public/temp/comisiones.csv', "r")) !== FALSE) {
                fgetcsv($gestor, 1000, ",");
                while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                   $numero = str_replace('"', '',$vars[0]);
                   $periodo = str_replace('"', '',$vars[2]);
                   try{
                        $simc = \DB::table('simcards')->where('numero', '=',$numero)->first();
                        if($simc == null){
                            $ICC = \DB::table('simcards')->select('ICC')->orderBy(\DB::raw('ICC*1'))->first();
                            $ICC = $ICC->ICC - 1;
                            $simc = \App\Simcard::create([
                             'ICC' => $ICC,
                             'numero' => $numero,
                             'fecha_vencimiento' => null,
                             'fecha_activacion' =>  null,
                             'nombreSubdistribuidor' => 'SIN ASIGNAR',
                             'tipo' => 1,
                             'paquete' => 0,
                             'fecha_entrega' => null
                             ]);
                        }
                        \App\Comision::create([
                                 'ICC' => $simc->ICC,
                                 'valor' => $vars[1],
                                 'periodo' => $periodo,
                                 ]);   
                   }catch(Exception $e){
                   }
                }
                fclose($gestor);
                unlink('public/temp/comisiones.csv');
            }
        }*/
    }
}
