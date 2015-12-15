<?php

use Illuminate\Database\Seeder;

class agregarArchivoSimcards extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Subir archivo simcards...');
        if (file_exists('public/temp/simcards.csv')) {
            if (($gestor = fopen('public/temp/simcards.csv', "r")) !== FALSE) {
                $opcion = fgetcsv($gestor, 1000, ",");
                if($opcion[0] == 'AGREGAR'){
                    $this->command->info('AGREGANDO...');
                    while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                        $fecha_vencimiento = date_create_from_format("d/m/y",$vars[3]);
                        $simc = \DB::table('simcards')->where('numero', '=',$vars[0])->orwhere('ICC', '=',$vars[1])->first();
                        if($simc != null){
                            $sim = \App\Simcard::find($simc->ICC);
                            $sim->delete();
                        }
                        \App\Simcard::create([
                         'numero' => $vars[0],
                         'ICC' => $vars[1],
                         'fecha_vencimiento' => $fecha_vencimiento,
                         'fecha_activacion' =>  null,
                         'nombreSubdistribuidor' => $vars[2],
                         'tipo' => $vars[4],
                         'paquete' => 0,
                         'fecha_entrega' => null
                         ]);
                    }
                }else if($opcion[0] == 'ACTIVAR'){
                    $this->command->info('ACTIVANDO...');
                    while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                       $fecha_activacion = date_create_from_format("d/m/y",$vars[1]);
                       $simc = \DB::table('simcards')->where('numero', '=',$vars[0])->first();
                       if($simc == null){
                           $ICC = \DB::table('simcards')->select('ICC')->orderBy(\DB::raw('ICC*1'))->first();
                           $ICC = $ICC->ICC - 1;
                           $fecha_vencimiento = date_add($fecha_activacion,date_interval_create_from_date_string("9 months"));
                           $fecha_activacion = date_create_from_format("d/m/y",$vars[1]);
                           \App\Simcard::create([
                             'numero' => $vars[0],
                             'ICC' => $ICC,
                             'fecha_vencimiento' => $fecha_vencimiento,
                             'fecha_activacion' =>  null,
                             'nombreSubdistribuidor' => 'SIN ASIGNAR',
                             'tipo' => 1,
                             'paquete' => 0,
                             'fecha_entrega' => null
                             ]);
                       }else{
                           $ICC = $simc->ICC;
                       }
                       $sim = \App\Simcard::find($ICC);
                       if($sim->tipo == 1){
                            $fecha_vencimiento = date_add($fecha_activacion,date_interval_create_from_date_string("9 months"));
                       }else{
                           $fecha_vencimiento = date_add($fecha_activacion,date_interval_create_from_date_string("12 months"));
                       }
                       $fecha_activacion = date_create_from_format("d/m/y",$vars[1]);
                       $sim->fecha_activacion = $fecha_activacion;
                       $sim->fecha_vencimiento = $fecha_vencimiento;
                       $sim->save();
                    }
                }
                fclose($gestor);
                unlink('public/temp/simcards.csv');
            }
        }
    }
}
