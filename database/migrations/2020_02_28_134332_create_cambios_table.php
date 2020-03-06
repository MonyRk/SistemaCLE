<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios', function (Blueprint $table) {
            $table->increments('id_cambio');
            $table->string('usuario');
            $table->date('fecha_cambio');
            $table->unsignedInteger('boleta');
            $table->foreign('boleta')->references('id_boleta')->on('boletas')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('calif1_previo');
            $table->integer('calif2_previo');
            $table->integer('calif3_previo');
            $table->integer('calif1_nuevo');
            $table->integer('calif2_nuevo');
            $table->integer('calif3_nuevo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cambios');
    }
}
