<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultPreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_pregunta', function (Blueprint $table) {
            $table->increments('id_rp');
            $table->unsignedInteger('id_pregunta');
            $table->foreign('id_pregunta')->references('id_pregunta')->on('preguntas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('id_respuesta');
            $table->foreign('id_respuesta')->references('id_respuesta')->on('respuestas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('num_evaluacion');
            $table->foreign('num_evaluacion')->references('num_evaluacion')->on('evaluacion')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->softDeletes();
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
        Schema::dropIfExists('respuestas');
    }
}
