<?php

use Illuminate\Database\Seeder;

class agregarRecargasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Subir archivo recargas...');
        if (file_exists('public/temp/recargas.csv')) {
            if (($gestor = fopen('public/temp/recargas.csv', "r")) !== FALSE) {
                while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                   $numero = $vars[0];
                   $fecha_recarga = date_create_from_format("d/m/y",$vars[1]);
                   try{
                        $simc = \DB::table('simcards')->where('numero', '=',$numero)->first();
                        if($simc == null){
                            
                        }else{
                        \App\Recarga::create([
                                 'ICC' => $simc->ICC,
                                 'valor_recarga' => $vars[2],
                                 'fecha_recarga' => $fecha_recarga,
                                 ]);   
                        }
                   }catch(Exception $e){
                       $this->command->info($e);
                       break;
                   }
                }
                fclose($gestor);
                unlink('public/temp/recargas.csv');
            }
        }
    }
}
