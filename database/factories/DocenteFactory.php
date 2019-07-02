<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory 
id_docente	curp_docente	grado_estudios	titulo	deleted_at
*/


use Faker\Generator as Faker;
use App\Docente;

$factory->define(Docente::class, function (Faker $faker) {
    return [
        'rfc' => $faker->randomNumber(8),
        'grado_estudios' => $faker->randomElement($array = array('Licenciatura','Maestría','Doctorado')),
        'titulo' => $faker->randomElement($array('Enseñanza de Lenguas Extranjeras','Traducción e Interpretación','Ciencias Educativas con Enfoque Universitario')),
        'ced_prof' => $faker->randomNumber(8)
    ];
});
