<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosInscritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_inscrito', function (Blueprint $table) {
            $table->increments('num_inscripcion');
            $table->unsignedInteger('id_grupo')->nullable();
            $table->foreign('id_grupo')->references('id_grupo')->on('grupos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('num_control');
            $table->foreign('num_control')->references('num_control')->on('alumnos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('folio_pago')->nullable();
            $table->integer('monto_pago')->nullable();
            $table->date('fecha')->nullable();
            $table->boolean('pago_verificado')->nullable();
            $table->integer('periodo_pago')->nullable();
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
        Schema::dropIfExists('alumno_inscrito');
    }
}
