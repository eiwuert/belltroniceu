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
    }
}
