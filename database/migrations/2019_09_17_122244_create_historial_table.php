<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->increments('id_historial');
            $table->integer('num_control');
            $table->string('nombre');
            $table->string('carrera');
            $table->integer('semestre');
            $table->string('periodo')->nullable();
            $table->integer('anio')->nullable();
            $table->string('nivel')->nullable();
            $table->string('modulo')->nullable();
            $table->string('grupo')->nullable();
            $table->boolean('A1M1')->nullable();
            $table->integer('calif1')->nullable();
            $table->boolean('A2M1')->nullable();
            $table->integer('calif2')->nullable();
            $table->boolean('A2M2')->nullable();
            $table->integer('calif3')->nullable();
            $table->boolean('B1M1')->nullable();
            $table->integer('calif4')->nullable();
            $table->boolean('B1M2')->nullable();
            $table->integer('calif5')->nullable();
            // $table->integer('calif_final')->nullable();
            $table->timestamps();
            //la columna de los niveles es para saber que curso llevo y lleva actualmente
            //conociendo cual es el ultimo nivel con true ese es el que se esta cursando a menos
            //que la columna correspondiente a su calificacion tenga ya una calificacion entonces el curso ya se 
            //aprobo 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial');
    }
}
