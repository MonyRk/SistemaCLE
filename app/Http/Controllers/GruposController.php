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
use Illuminate\Support\Facades\DB;

class GruposController extends Controller
{
    
    public function index()
    {
        $grupos = DB::table('grupos')
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
        ->leftJoin('personas','personas.curp','=','docentes.curp_docente')
        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        ->whereNull('grupos.deleted_at')
        ->orderBy('grupos.grupo','ASC')
        ->paginate(25);

        $docentes = Persona::leftjoin('docentes','docentes.curp_docente','=','personas.curp')
        ->select('docentes.*','personas.*')
        ->get();

        $niveles = Nivel::select('*')
        ->get();

        $periodos = Periodo::select('*')
        ->get();
        
        $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
        ->select('aulas.*','horas_disponibles.*')
        ->get();
        return view('grupos.grupos',compact('grupos','niveles','aulas','periodos','docentes'));
    }


    public function search(Request $request)
    {
        $search = $request->all();
        
        $grupos = DB::table('grupos')
                ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
                ->whereNull('grupos.deleted_at')
                ->where('grupos.grupo','like','%'.$search['buscar'].'%')
                ->orWhere('nivels.nivel','like','%'.$search['buscar'].'%')
                ->orWhere('nivels.modulo','like','%'.$search['buscar'].'%')
                ->orWhere('nivels.idioma','like','%'.$search['buscar'].'%')
                ->orWhere('aulas.num_aula','like','%'.$search['buscar'].'%')
                ->orWhere('aulas.edificio','like','%'.$search['buscar'].'%')
                ->orWhere('periodos.descripcion','like','%'.$search['buscar'].'%')
                ->orWhere('periodos.anio','like','%'.$search['buscar'].'%')
                ->paginate(25)
                ->appends('buscar',$search['buscar']);

                $docentes = Persona::leftjoin('docentes','docentes.curp_docente','=','personas.curp')
                ->select('docentes.*','personas.*')
                ->get();

                $niveles = Nivel::select('*')
                ->get();

                $periodos = Periodo::select('*')
                ->get();
                
                $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
                ->select('aulas.*','horas_disponibles.*')
                ->get();
                        
        return view ('grupos.grupos',compact('grupos','niveles','aulas','periodos','docentes'));
    }
  
    public function create()
    {
        $niveles = Nivel::select('*')->get();

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

        return view('grupos.createGrupo',compact('maestros','periodos','aulas','horasaula','niveles'));
    }

 
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|alpha_spaces',
            'nivel' => 'required',
            'modalidad' => 'required',
            'aula' => 'required',
            'hora' => 'required',
            'docente' => 'required',
            'periodo' => 'required',
            'cupo' => 'required|digits:2'
        ]);
        $columnaConLaHora = 'hora'.($data['hora'] + 1);
        $aulaSeleccionadaConHoras = HorasDisponible::leftjoin('aulas','horas_disponibles.id_hora','=','aulas.hrdisponible')
                            ->where('id_aula',$data['aula'])                    
                            ->get();

        $maestrosEnGrupo = Grupo::select('*')
                ->where('docente',$data['docente'])
                ->get();

        $i = 0;
        foreach ($maestrosEnGrupo as $maestro) {
            
            if ($maestro->hora == $aulaSeleccionadaConHoras[0]->$columnaConLaHora && $maestro->periodo == $data['periodo'] && $maestro->modalidad == $data['modalidad']) {
                $i++;//si son a la misma hora, el mismo periodo y la misma modalidad
            }else{
                //si son diferentes de hora y de periodo y 
                $i;
            }
        }

        if($i>0){
            return redirect()->route('crearGrupo')->with('warning','Revise los datos, el Docente ya tiene un grupo asignado a esa hora');
        }else{ 
            $nuevo_grupo = Grupo::create([
                'grupo' => $data['name'],
                'nivel_id' => $data['nivel'],
                'modalidad' => $data['modalidad'],
                'aula' => $data['aula'],
                'docente' => $data['docente'],
                'periodo' => $data['periodo'],
                'cupo' => $data['cupo'],
                'hora' => $aulaSeleccionadaConHoras[0]->$columnaConLaHora
            ]);
        
            DB::update('update horas_disponibles set '.$columnaConLaHora.' = null where id_hora = ?', [$aulaSeleccionadaConHoras[0]->hrdisponible]);
            
        }
// dd($nuevo_grupo);
        DB::update('update grupos set cupo = ? where id_grupo = ?', [$data['cupo'],$nuevo_grupo->id_grupo]); //falta modificar el cupo del grupo
        
        return redirect()->route('verGrupos')->with('success','!El nuevo grupo se ha creado correctamente!');
    }

    public function show($id)
    {
        $datos = Grupo::leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        ->where('grupos.id_grupo',$id)
        ->select('grupos.*','nivels.*','aulas.*','docentes.*','periodos.*')
        ->get();

        $docente = Persona::leftjoin('docentes','docentes.curp_docente','=','personas.curp')
        ->where('docentes.id_docente',$datos[0]->id_docente)
        ->select('docentes.*','personas.*')
        ->get();

        return view('grupos.showGrupo',compact('datos','docente'));


    }

    public function edit(Grupo $grupo)
    {
        $grupos = DB::table('grupos')
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        ->leftJoin('personas','docentes.curp_docente','=','personas.curp')
        ->where('id_grupo',$grupo->id_grupo)
        ->get();

        $maestros = Persona::rightjoin('docentes','docentes.curp_docente','=','personas.curp')
        // ->select('docentes.*','personas.*')
        ->whereNull('personas.deleted_at')
        ->get();
        // dd($maestros);
        $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
        ->select('aulas.*','horas_disponibles.*')
        ->get();  


        $niveles = Nivel::select('*')->get();

        $periodos = Periodo::select('*')
        ->get();

        return view ('grupos.editGrupo',compact('grupos','maestros','aulas','niveles','periodos'));
    }

    public function update(Request $request)
    { 
        
        $data = request()->validate([
            'name' => 'required|alpha_spaces',
            'nivel' => 'required',
            'modalidad' => 'required',
            'aula' => 'required',
            'hora' => 'required',
            'docente' => 'required',
            'periodo' => 'required',
            'cupo' => 'required|numeric|between:15,50'
        ]);
        // dd($data);
        $grupo = Grupo::find(request()->id_grupo)->update([
            'grupo' => $data['name'],
            'nivel_id' => $data['nivel'],
            'modalidad' => $data['modalidad'],
            'aula' => $data['aula'],
            'hora' => $data['hora'],
            'docente' => $data['docente'],
            'periodo' => $data['periodo'],
            // 'cupo' => $data['cupo']
        ]);

        DB::update('update grupos set cupo = ? where id_grupo = ?', [$data['cupo'],request()->id_grupo]);
        
        return redirect()->route('verGrupos')->with('success','¡El grupo se actualizó correctamente!');
    }

    public function destroy(Request $request)
    {
      
        $grupo = Grupo::where('id_grupo',$request->grupo_id)->get();
          
        //volver a poner la hora disponible en el aula
        $aula= Aula::where('id_aula',$grupo[0]->aula)
                    ->leftJoin('horas_disponibles','aulas.hrdisponible','=','horas_disponibles.id_hora')
                    ->get();
        $i=1;
        while ($i < 14) { 
            $hora = 'hora'.$i;
            if ($aula[0]->$hora == null) {
                DB::update('update horas_disponibles set '.$hora.' = ? where id_hora = ?', [$grupo[0]->hora,$aula[0]->id_hora]);
                $i=14;
            }else{
                $i++;
            }

        }

       $grupo[0]->delete();
        
        return redirect()->route('verGrupos')->with('warning','Los datos del grupo se eliminaron');
  
    }

    public function getAulas(Request $request)
    { 
        if($request->ajax()){
            $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
                            ->where('id_aula',$request->id_aula)
                            ->get();

            foreach ($aulas as $aula) {
                $aulasArray[$aula->hrdisponible] = array ($aula->hora1, $aula->hora2, $aula->hora3,$aula->hora4, $aula->hora5, $aula->hora6,$aula->hora7, $aula->hora8, $aula->hora9,$aula->hora10, $aula->hora11, $aula->hora12,$aula->hora13);
            }
            return response()->json($aulasArray);
        }
    }

}
