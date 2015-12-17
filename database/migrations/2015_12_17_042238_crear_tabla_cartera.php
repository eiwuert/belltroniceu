<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCartera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->date('fecha');
            $table->boolean('deuda');
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->integer('valor_unitario');
            $table->timestamps();
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
