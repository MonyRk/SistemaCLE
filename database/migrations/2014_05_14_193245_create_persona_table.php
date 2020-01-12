<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('curp',20)->primary();
            $table->string('nombres', 60);
            $table->string('ap_paterno',50);
            $table->string('ap_materno',50)->nullable();
            $table->string('calle',70)->nullable();
            $table->integer('numero')->nullable();
            $table->string('colonia',90)->nullable();
            $table->integer('municipio')->nullable();
            $table->foreign('municipio')->references('id')->on('municipios')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('cp')->nullable();
            $table->string('telefono',20)->nullable();
            $table->smallinteger('edad');
            $table->enum('sexo', ['F','M']);
            $table->enum('tipo',['alumno','docente','coordinador'])->default('alumno');
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
        Schema::dropIfExists('persona');
    }
}
