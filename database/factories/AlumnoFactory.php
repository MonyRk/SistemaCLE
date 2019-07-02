<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Alumno;
use App\Persona;
use Faker\Generator as Faker;

$factory->define(Alumno::class, function (Faker $faker) {

    
    return [
       'num_control' => $faker->randomNumber(8,false),
       'carrera' => $faker->randomElement($array = array('Ingeniería Eléctrica','Ingeniería Electrónica','Ingeniería Civil','Ingeniería Mecánica','Ingeniería Industrial','Ingeniería Química','Ingeniería en Gestión Empresarial','Ingeniería en Sist. Computacionales','Licenciatura en Administración')),
        'semestre' => $faker->numberBetween(1,12),
        'estatus' => $faker->randomElement($array = array('Inscrito', 'No Inscrito'))
   ];

});
