<?php

namespace App\Http\Controllers;

use App\Aula;
use App\HorasDisponible;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Psy\Command\WhereamiCommand;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora' ,'=','aulas.hrdisponible')
                ->select('aulas.*','horas_disponibles.*')
                ->orderBy('aulas.edificio','ASC')
                ->orderBy('aulas.num_aula','ASC')
                ->paginate(25);

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

        $aulacreate = Aula::updateOrCreate([  //Aula::firstOrCreate([
            'num_aula' => $data['aula'],
            'edificio' => $data['edificio']
        ],[
            'hrdisponible' => $last_hora->id_hora
        
        ]);
        
        return redirect()->route('verAulas')->with('success','¡Los datos del aula se guardaron correctamente!');
        
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
        $aula1 = Aula::where('id_aula',$aula->id_aula)
                        ->leftJoin('horas_disponibles','aulas.hrdisponible','=','horas_disponibles.id_hora')
                        ->get();
        $horas = HorasDisponible::where('id_hora',$aula->hrdisponible)->get();
        // dd($aula1);
        return view('catalogos.aulas.editAula',compact('aula1','horas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function update(Aula $aula)
    {
        $data = request()->all();
        $values = ""; 
        $count = count($data['horas']);
       
        for ($i=0; $i < 14; $i++) { 
            if($i<$count){
               $values=$values.'hora'.($i+1).' = "'.$data['horas'][$i].'", ';
            }else{
               $values=$values.'hora'.($i+1).' = NULL, ';
            }
        }
        
        $values=substr($values,0,-17); 
        
        DB::update('update horas_disponibles set '.$values.' where id_hora = ?', [$aula->hrdisponible]);
       
        Aula::find($aula->id_aula)->update([
            'num_aula' => $data['aula'],
            'edificio' => $data['edificio']
        ]);

        return redirect()->route('verAulas')->with('success','¡Los datos del aula se actualizaron correctamente!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { //dd(request()->all());
        $aulae = Aula::where('id_aula','=', $request->aula_id)->get();

        $horariodisponible = HorasDisponible::where('id_hora',$aulae[0]->hrdisponible)->get();

        $aulae[0]->delete();
        $horariodisponible[0]->delete();
        return redirect()->route('verAulas')->with('warning','Los datos del aula se han eliminado.');
    }
}
