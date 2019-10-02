<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->increments('id_pregunta');
            $table->string('pregunta');
            $table->string('vigencia');
            $table->enum('tipo',array('Enfoque de Enseñanza','Clima Afectivo','Proceso de Enseñanza','Estrategias de Retroalimentación'));
            $table->unsignedInteger('id_grupoRespuesta');
            $table->foreign('id_grupoRespuesta')->references('id_grupoRespuesta')->on('grupo_respuesta')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('preguntas');
    }
}
