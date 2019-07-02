<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Docente;
use App\Persona;
use App\Http\Controllers\DocentesController;

class DocentesSeeder extends Seeder
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

        factory(Docente::class)->create([
           'curp_docente' => $curp_value
         ]);
          }
    }
}
