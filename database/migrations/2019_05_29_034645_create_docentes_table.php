<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->increments('id_docente');
            $table->string('curp_docente',20);
            $table->foreign('curp_docente')->references('curp')->on('personas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('rfc');
            $table->string('grado_estudios');
            $table->string('titulo');
            $table->string('ced_prof');
            $table->enum('estatus',['Activo','Inactivo'])->default('Activo');
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
        Schema::dropIfExists('docentes');
    }
}
