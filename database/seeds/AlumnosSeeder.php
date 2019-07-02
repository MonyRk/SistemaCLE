<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Alumno;
use App\Persona;
use App\Http\Controllers\AlumnosController;

class AlumnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         for ($i=0; $i < 19; $i++) { 
             $curp = DB::table('personas')->pluck('curp');
            //$curp = DB::table('personas')->select('curp')->pluck('curp');
             // $curp = Persona::pluck('curp')->random(1)->all();
             $curp_value = $curp[$i]; 

         factory(Alumno::class)->create([
            'curp_alumno' => $curp_value
          ]);
           }  
              //dd($curp_value);
         }
                 
         
       

    //    Alumno::create([
    //             'num_control' => '1816',
    //             'curp_alumno' => $curp_value,
    //             'carrera' => 'Ingeniería Industrial',
    //             'semestre' => '8'
                  
    //         ]);

    
}