<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Persona;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Persona::create([
        //         'curp' => '1114',
        //         'nombres' => 'Ricardo',
        //         'ap_paterno' => 'García',
        //         'ap_materno' => 'García',
        //         'dia' => '24',
        //         'mes' => '11',
        //         'anio' => '1995',
        //         'telefono' => '9511967390',
        //         'edad' => '24',
        //         'sexo' => 'M'      
        //     ]);

        // Persona::create([
        //     'curp' => '1113',
        //     'nombres' => 'Adriana',
        //     'ap_paterno' => 'Espina',
        //     'ap_materno' => 'Vasquez',
        //     'dia' => '4',
        //     'mes' => '3',
        //     'anio' => '1990',
        //     'telefono' => '9512116556',
        //     'edad' => '29',
        //     'sexo' => 'F',
        //     'tipo' => 'docente'      
        // ]);

        factory(Persona::class,20)->create();
    }
}
