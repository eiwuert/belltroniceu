<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRecargas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recargas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ICC');
            $table->date('fecha_recarga');
            $table->integer('valor_recarga');
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
         Schema::dropIfExists('recargas');
    }
}
