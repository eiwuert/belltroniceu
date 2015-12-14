<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaComisiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('comisiones',function(Blueprint $table){
            $table->increments('id');
            $table->string('ICC');
            $table->integer('valor');
            $table->string('periodo');
            $table->timestamps();
            $table->foreign('ICC')->references('ICC')->on('simcards')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comisiones');
    }
}
