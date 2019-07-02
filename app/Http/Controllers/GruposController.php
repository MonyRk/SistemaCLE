<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\Nivel;
use App\Aula;
use App\Docente;
use App\Persona;
use App\Periodo;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupo::join('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->join('aulas','aulas.id_aula','=','grupos.aula')
        ->join('docentes','docentes.id_docente','=','grupos.docente')
        ->join('periodos','periodos.id_periodo','=','grupos.periodo')
        ->select('nivels.*','aulas.*','docentes.*','periodos.*','grupos.*')
        ->get();

        $docentes = Persona::join('docentes','docentes.curp_docente','=','personas.curp')
        ->select('docentes.*','personas.*')
        ->get();

        $niveles = Nivel::select('*')
        ->get();

        $periodos = Periodo::select('*')
        ->get();
        
        $aulas = Aula::join('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
        ->select('aulas.*','horas_disponibles.*')
        ->get();
        return view('grupos.grupos',compact('grupos','niveles','aulas','periodos','docentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = Grupo::join('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->join('aulas','aulas.id_aula','=','grupos.aula')
        ->join('docentes','docentes.id_docente','=','grupos.docente')
        ->join('periodos','periodos.id_periodo','=','grupos.periodo')
        ->select('nivels.*','aulas.*','docentes.*','periodos.*','grupos.*')
        ->get();

        $maestros = Docente::join('personas','docentes.curp_docente','=','personas.curp')
        ->select('personas.*','docentes.*')
        ->get();

        $periodos = Periodo::select('*')
        ->get();

        $horasaula = Aula::join('horas_disponibles','horas_disponibles.id_hora' ,'=','aulas.hrdisponible')
                ->select('aulas.*','horas_disponibles.*')
                ->get();
//dd($horasaula[4]);
        return view('grupos.createGrupo',compact('grupos','maestros','periodos','horasaula'));
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
        $grupos_con_el_maestro = Grupo::select('*')
                ->where('docente',$data['docente'])
                ->get();
                //dd($grupos_con_el_maestro);
            if($grupos_con_el_maestro->hora = $data['hora'] || $grupos_con_el_maestro->aula = $data['aula']){
                echo('Revise la información, el docente o el aula ya tienen un grupo asignado');
            }else{
                Grupo::create([
                    'grupo' => $data['name'],
                    'modalidad' => $data['modalidad'],
                    'nivel_id' => $data['nivel'],
                    'aula' => $data['aula'],
                    'docente' => $data['docente'],
                    'periodo' => $data['periodo'],
                    'hora' => $data['hora']
                ]);
            }
        
        
        

        return redirect()->route('verGrupos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        //
    }

    public function getAulas(Request $request)
    {
        if($request->ajax()){
            $aulas = Aula::where('id_aula', $request->id_aula)->get();//join('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')->select('aulas.*','horas_disponibles.*')->get();
            foreach ($aulas as $aula) {
                $aulasArray[$aula->id_aula] = $aula->hrdisponible;
            }
            return response()->json($aulasArray);
        }
    }
}
