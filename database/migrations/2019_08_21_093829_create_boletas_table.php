<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->increments('id_boleta'); // UNSIGNED INTEGER
            $table->integer('num_control');
            $table->foreign('num_control')->references('num_control')->on('alumnos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('id_grupo');
            $table->foreign('id_grupo')->references('id_grupo')->on('grupos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('calif1')->nullable();
            $table->integer('calif2')->nullable();
            $table->integer('calif3')->nullable();
            $table->integer('calif_f')->nullable();
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
        Schema::dropIfExists('boletas');
    }
}
