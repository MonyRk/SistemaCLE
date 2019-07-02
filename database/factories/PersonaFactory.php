<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Persona;
use Faker\Generator as Faker;
use Psy\Util\Str;

$factory->define(Persona::class, function (Faker $faker) {
    return [
        'curp' => $faker->bothify('fjls##??'),
        'nombres' => $faker->firstName(null),
        'ap_paterno' => $faker->lastName(null),
        'ap_materno' => $faker->lastName(null),
        'calle' => $faker->word,
        'numero' => $faker->randomNumber(3),
        'colonia' => $faker->word,
        'municipio' => $faker->numberBetween(1,570),
        'telefono' => $faker->tollFreePhoneNumber,
        'edad' => $faker->randomNumber(2,false),
        'sexo' => $faker->randomElement($array = array('F','M')),
        'tipo' => $faker->randomElement($array = array('docente','alumno'))
    ];
});
