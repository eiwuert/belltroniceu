<?php

use Illuminate\Database\Seeder;

class agregarArchivoCartera extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Subir archivo cartera...');
        if (file_exists('public/temp/cartera.csv')) {
            if (($gestor = fopen('public/temp/cartera.csv', "r")) !== FALSE) {
                while (($vars = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                   $fecha = date_create_from_format("d/m/y",$vars[0]);
                   $descripcion = $vars[1];
                   $cantidad = $vars[2];
                   $valor_unitario = $vars[3];
                   $email = 'ENRIQUE@hotmail.com';
                   try{
                        \App\Cartera::create([
                                 'email' => $email,
                                 'fecha' => $fecha,
                                 'descripcion' => $descripcion,
                                 'cantidad' => $cantidad,
                                 'valor_unitario' => $valor_unitario,
                                 ]);   
                   }catch(Exception $e){
                       $this->command->info($e);
                       break;
                   }
                }
                fclose($gestor);
                unlink('public/temp/cartera.csv');
            }
        }
    }
}
