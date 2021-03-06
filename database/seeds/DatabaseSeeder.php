<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(agregarComisionesSeeder::class);
        //$this->call(agregarArchivoSimcards::class);
        //$this->call(agregarRecargasSeeder::class);
        //$this->call(agregarArchivoCartera::class);
        //$this->call(AsesoresSeeder::class);
        Model::reguard();
    }
}
