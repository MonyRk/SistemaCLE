<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->integer('num_control')->primary();
            $table->string('curp_alumno',20);
            $table->foreign('curp_alumno')->references('curp')->on('personas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->enum('carrera',['Ingeniería Eléctrica',
                                    'Ingeniería Electrónica',
                                    'Ingeniería Civil',
                                    'Ingeniería Mecánica',
                                    'Ingeniería Industrial',
                                    'Ingeniería Química',
                                    'Ingeniería en Gestión Empresarial',
                                    'Ingeniería en Sist. Computacionales',
                                    'Licenciatura en Administración']);
            $table->enum('semestre',['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16']);
            $table->enum('estatus',['Inscrito','No Inscrito']);
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
        Schema::dropIfExists('alumnos');
    }
}
