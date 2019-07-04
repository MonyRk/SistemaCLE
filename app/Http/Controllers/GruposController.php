<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\Nivel;
use App\Aula;
use App\Docente;
use App\Persona;
use App\Periodo;
use App\HorasDisponible;
use App\Http\Requests\ValidarCrearGrupoRequest;

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

        $aulas = Aula::select('*')
        ->get();

        $horasaula = Aula::join('horas_disponibles','horas_disponibles.id_hora' ,'=','aulas.hrdisponible')
                ->select('aulas.*','horas_disponibles.*')
                ->get();
//dd($horasaula[4]);
        return view('grupos.createGrupo',compact('grupos','maestros','periodos','aulas','horasaula'));
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
        $columnaConLaHora = 'hora'.($data['hora'] + 1);
        $aulaSeleccionadaConHoras = HorasDisponible::join('aulas','horas_disponibles.id_hora','=','aulas.hrdisponible')
                            ->where('id_aula',$data['aula'])                    
                            ->get();

                            
      // dd($aulaSeleccionadaConHoras->$columnaConLaHora);

        $maestrosEnGrupo = Grupo::select('*')
                ->where('docente',$data['docente'])
                ->get();
                $i = 0;
                foreach ($maestrosEnGrupo as $maestro) {
                    
                    if ($maestro->hora != $aulaSeleccionadaConHoras[0]->$columnaConLaHora) {
                        //si son diferentes
                    }else{
                       //si son iguales
                        $i++;
                }
            }
            //dd($maestrosEnGrupo,$aulaSeleccionadaConHoras[0]->$columnaConLaHora);
            if($i>0){
                trigger_error('Revise la información, el docente o el aula ya tienen un grupo asignado', E_NOTICE);
            }else{
                Grupo::create([
                    'grupo' => $data['name'],
                    'modalidad' => $data['modalidad'],
                    'nivel_id' => $data['nivel'],
                    'aula' => $data['aula'],
                    'docente' => $data['docente'],
                    'periodo' => $data['periodo'],
                    'hora' => $aulaSeleccionadaConHoras[0]->$columnaConLaHora
                ]);
            
                 
            // ya quedo
                $hora = HorasDisponible::find(($aulaSeleccionadaConHoras[0]->hrdisponible));
                $hora->$columnaConLaHora = null;
                $hora->save();
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
    { //where('id_aula', $request->id_aula)
        if($request->ajax()){
            $aulas = Aula::join('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
                            //->select('aulas.*','horas_disponibles.*')
                            ->where('id_aula',$request->id_aula)
                            ->get();
                            //dd($aulas);
            foreach ($aulas as $aula) {
                $aulasArray[$aula->hrdisponible] = array ($aula->hora1, $aula->hora2, $aula->hora3,$aula->hora4, $aula->hora5, $aula->hora6,$aula->hora7, $aula->hora8, $aula->hora9,$aula->hora10, $aula->hora11, $aula->hora12,$aula->hora13);
            }
            return response()->json($aulasArray);
        }
    }
}
