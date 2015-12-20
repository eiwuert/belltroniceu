<?php

use Illuminate\Database\Seeder;

class AsesoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Subir archivo asesores...');
        if (file_exists('public/temp/asesores.csv')) {
            if (($gestor = fopen('public/temp/asesores.csv', "r")) !== FALSE) {
                while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                   $cedula = $vars[0];
                   $nombre = $vars[1];
                   try{
                        \App\Asesor::create([
                                 'cedula' => $cedula,
                                 'nombre' => $nombre,
                                 ]);   
                   }catch(Exception $e){
                   }
                }
                fclose($gestor);
                unlink('public/temp/asesores.csv');
            }
        }
    }
}
