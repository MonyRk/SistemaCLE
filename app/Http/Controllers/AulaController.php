<?php

namespace App\Http\Controllers;

use App\Aula;
use App\HorasDisponible;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aulas = Aula::join('horas_disponibles','horas_disponibles.id_hora' ,'=','aulas.hrdisponible')
                ->select('aulas.*','horas_disponibles.*')
                // ->whereNotNull('hora1')
                // ->whereNotNull('hora2')//,'hora2','hora3','hora4','hora5','hora6','hora7','hora8','hora9','hora10','hora11','hora12','hora13')
                ->get();
                //dd($aulas);
        return view('catalogos.aulas.aulas',compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     { 
        $data = request()->all();
        $values = "";
        $count = count($data['horas']);
       
        for ($i=0; $i < 14; $i++) { 
            if($i<$count){
               $values=$values.'"'.$data['horas'][$i].'",';
            }else{
               $values=$values.'NULL,';
            }
        }
        
        $values=substr($values,0,-1);

        DB::insert('INSERT INTO `horas_disponibles` (`id_hora`, `hora1`, `hora2`, `hora3`, `hora4`, `hora5`, `hora6`, `hora7`, `hora8`, `hora9`, `hora10`, `hora11`, `hora12`, `hora13`, `deleted_at`) VALUES (NULL,'.$values.');');
       
        $last_hora = HorasDisponible::select('id_hora')->orderBy('id_hora', 'DESC')->first();
        
        Aula::firstOrCreate([
            'num_aula' => $data['aula'],
            'edificio' => $data['edificio'],
            'hrdisponible' => $last_hora->id_hora
        
        ]);
        
        return redirect()->route('verAulas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function show(Aula $aula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function edit(Aula $aula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aula $aula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aula $aula)
    {
        $aulae = Aula::where('id_aula','=', $aula->id_aula);
        $aulae->delete();
        return redirect()->route('verAulas');
    }
}
