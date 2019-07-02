<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id_grupo');
            $table->string('grupo');
            $table->enum('modalidad',['Semanal','Sabatino'])->default('Semanal');
            $table->unsignedInteger('nivel');
            $table->foreign('nivel_id')->references('id_nivel')->on('nivels')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('aula');
            $table->foreign('aula')->references('id_aula')->on('aulas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('docente');
            $table->foreign('docente')->references('id_docente')->on('docentes')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('periodo');
            $table->foreign('periodo')->references('id_periodo')->on('periodos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->time('hora');
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
        Schema::dropIfExists('grupos');
    }
}
