<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->increments('id_aula');
            $table->tinyInteger('num_aula',false);
            $table->char('edificio',2);
            $table->unsignedInteger('hrdisponible');
            $table->foreign('hrdisponible')->references('id_hora')->on('horas_disponibles')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aulas');
    }
}
