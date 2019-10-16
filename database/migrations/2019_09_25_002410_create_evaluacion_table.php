<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion', function (Blueprint $table) {
            $table->increments('num_evaluacion');
            $table->integer('num_control');
            $table->foreign('num_control')->references('num_control')->on('alumnos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('curp_docente');
            $table->foreign('curp_docente')->references('curp_docente')->on('docentes')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('grupo');
            $table->unsignedInteger('periodo');
            $table->foreign('periodo')->references('id_periodo')->on('periodos')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('evaluacion');
    }
}
