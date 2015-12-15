<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class AgregarArchivoComisiones extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $localPath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->localPath = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (($gestor = fopen($this->localPath, "r")) !== FALSE) {
            fgetcsv($gestor, 1000, ",");
            while (($vars = fgetcsv($gestor, 1000, ",")) !== FALSE) {
               $numero = str_replace('"', '',$vars[0]);
               $periodo = str_replace('"', '',$vars[2]);
               try{
                    $simc = \DB::table('simcards')->where('numero', '=',$numero)->first();
                    if($simc == null){
                        $fecha_vencimiento = date_add(new \DateTime('NOW'),date_interval_create_from_date_string("9 months"));
                        $ICC = \DB::table('simcards')->select('ICC')->orderBy(\DB::raw('ICC*1'))->first();
                        $ICC = $ICC->ICC - 1;
                        \App\Simcard::create([
                         'ICC' => $ICC,
                         'numero' => $numero,
                         'fecha_vencimiento' => $fecha_vencimiento,
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
                   return $e;
               }
            }
            fclose($gestor);
        }
    }
}
