<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorasDisponiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas_disponibles', function (Blueprint $table) {
            $table->increments('id_hora');
            $table->time('hora1')->nullable();
            $table->time('hora2')->nullable();
            $table->time('hora3')->nullable();
            $table->time('hora4')->nullable();
            $table->time('hora5')->nullable();
            $table->time('hora6')->nullable();
            $table->time('hora7')->nullable();
            $table->time('hora8')->nullable();
            $table->time('hora9')->nullable();
            $table->time('hora10')->nullable();
            $table->time('hora11')->nullable();
            $table->time('hora12')->nullable();
            $table->time('hora13')->nullable();
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
        Schema::dropIfExists('horas_disponibles');
    }
}
