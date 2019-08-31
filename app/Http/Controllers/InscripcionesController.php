<?php

namespace App\Http\Controllers;
use App\Grupo;
use App\Nivel;
use App\Aula;
use App\Alumno;
use App\AlumnoInscrito;
use App\Boleta;
use App\Persona;
use App\Periodo;
use App\HorasDisponible;
use App\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class InscripcionesController extends Controller
{
    public function index()
    {   
        $periodos = DB::table('periodos')->orderBy('anio','DESC')->orderBy('descripcion','ASC')->get();
        // dd($periodos);
        return view('inscripciones.periodoInscripciones',compact('periodos'));
        
    }

    public function search(Request $request)
    {
        $search = $request->all();

        $grupos_periodo = Grupo::leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                            ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                            ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                            ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
                            ->leftJoin('personas','docentes.curp_docente','=','personas.curp')
                            ->select('grupos.*','nivels.id_nivel', 'nivels.nivel','nivels.modulo', 'nivels.idioma', 'aulas.id_aula', 'aulas.num_aula', 'aulas.edificio', 'aulas.hrdisponible', 'periodos.id_periodo', 'periodos.descripcion', 'periodos.anio', 'docentes.id_docente', 'docentes.curp_docente', 'docentes.rfc', 'docentes.grado_estudios', 'docentes.titulo', 'docentes.ced_prof', 'docentes.estatus', 'personas.curp', 'personas.nombres', 'personas.ap_paterno', 'personas.ap_materno')
                            ->where('periodos.id_periodo',$search['per']);
                          
        $grupos = DB::table(DB::raw("({$grupos_periodo->toSql() }) as grupos_periodos"))
                    ->mergeBindings($grupos_periodo->getQuery())
                    ->orWhere('grupos_periodos.grupo','like','%'.$search['buscar'].'%')
                    ->orWhere('grupos_periodos.nivel','like','%'.$search['buscar'].'%')
                    ->orWhere('grupos_periodos.modulo','like','%'.$search['buscar'].'%')
                    ->orWhere('grupos_periodos.num_aula','like','%'.$search['buscar'].'%')
                    ->orWhere('grupos_periodos.edificio','like','%'.$search['buscar'].'%')
                    ->orderBy('grupos_periodos.nivel','ASC')
                    ->orderBy('grupos_periodos.modulo','ASC')
                    ->paginate(25)
                    ->appends('buscar',$search['buscar']);    

        $docentes = Persona::leftjoin('docentes','docentes.curp_docente','=','personas.curp')
        ->select('docentes.*','personas.*')
        ->get();

        $niveles = Nivel::select('*')
        ->get();

        $p = Periodo::select('*')
        ->where('id_periodo',$search['per'])
        ->get();
        
        $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
        ->select('aulas.*','horas_disponibles.*')
        ->get();
                
        return view ('inscripciones.inscripciones',compact('grupos','niveles','aulas','p','docentes'));
    }
    
    public function searchE(Request $request)//buscar por estudiante en el grupo a inscribir
    {
        $search = $request->all();
        
        $grupo = DB::table('grupos')
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->where('id_grupo',$search['grupo'])
        ->get();

        $alumnos = DB::table('alumnos')
        ->leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
        ->whereNull('personas.deleted_at')
        ->where('alumnos.num_control','like','%'.$search['buscar'].'%')
        ->orWhere('personas.nombres','like','%'.$search['buscar'].'%')
        ->orWhere('personas.ap_paterno','like','%'.$search['buscar'].'%')
        ->orWhere('personas.ap_materno','like','%'.$search['buscar'].'%')
        ->paginate(25)
        ->appends('buscar',$search['buscar']);   
                        
       return view('inscripciones.listaGrupo',compact('grupo','alumnos'))->with('success','probando');
    }


    //muestra la lista de ALUMNOS que se pueden agregar al grupo 
    public function create($id)
    {
        // dd($id);
        $grupo = DB::table('grupos')
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->where('id_grupo',$id)
        ->get();
//  dd($grupo);
        $alumnos_en_el_grupo = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
        ->leftjoin('alumno_inscrito','alumnos.num_control','=','alumno_inscrito.num_control')
        ->leftjoin('grupos','alumno_inscrito.id_grupo','=','grupos.id_grupo')
        ->whereNull('personas.deleted_at')
        ->whereNull('alumno_inscrito.deleted_at')
        ->where('alumno_inscrito.id_grupo',$id)
        ->get();

        $alumnos = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
        ->whereNull('personas.deleted_at')
        ->where('alumnos.estatus','No Inscrito')
        ->get();

       return view('inscripciones.listaGrupo',compact('grupo','alumnos','alumnos_en_el_grupo'))->with('success','probando');
    }

    public function store(Request $request)
    {
        $data = request()->all(); 
        
        //cuenta cuantos estudiantes estaran en el grupo
        $totalEstudiantes = Inscripcion::where('id_grupo',$data['grupo'])->count();
        if(request()->has('inscribir')){
            $totalEstudiantes += count(request()->input('inscribir'));
            $arrayInscribir = request()->input('inscribir');
        }
        if (request()->has('quitar')) {
            $totalEstudiantes -= count(request()->input('quitar'));
            $arrayQuitar = request()->input('quitar');
        }


        // dependiendo del cupo se agregan o no los estudiantes seleccionados
        if ($totalEstudiantes <= $data['cupo']) {
            if (request()->has('inscribir')) {
                    for ($i = 0; $i < count($arrayInscribir); $i++){
                        Inscripcion::firstOrCreate([
                            'id_grupo' => $data['grupo'],
                            'num_control' => $arrayInscribir[$i]
                        ]);
        
                        Alumno::find($arrayInscribir[$i])
                        ->update([
                            'estatus' => 'Inscrito'
                        ]);
        
                        Boleta::firstOrCreate([
                            'id_grupo' => $data['grupo'],
                            'num_control' => $arrayInscribir[$i]
                        ]);
                    }
            }
    
            if (request()->has('quitar')) {
                for ($i = 0; $i < count($arrayQuitar); $i++){
                    $this->destroy($arrayQuitar[$i],$data['grupo']);
                }
            }
            
        }else{
            return redirect()->route('inscribirEstudiantes',$data['grupo'])->with('error','La cantidad de estudiantes es mayor al cupo del grupo');
        }

        //se agregan los datos necesarios para la vista
        $p = Periodo::where('id_periodo',$data['periodo'])->get();
        $grupos = DB::table('grupos')
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        ->leftJoin('personas','personas.curp','=','docentes.curp_docente')
        ->whereNull('grupos.deleted_at')
        ->where('periodos.id_periodo','=',$data['periodo'])
        ->paginate(25);


        $niveles = Nivel::select('*')
        ->get();

        $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
        ->select('aulas.*','horas_disponibles.*')
        ->get();

        // return redirect()->route('inscripciones')
        //                 ->with('p',$p)->with('grupos',$grupos)
        //                 ->with('niveles',$niveles)->with('aulas',$aulas)
        //                 ->with('success','¡Los estudiantes se agregaron al grupo correctamente!');
        return view('inscripciones.inscripciones')->with('success','¡Los estudiantes se agregaron al grupo correctamente!')->with('p',$p)->with('grupos',$grupos)->with('niveles',$niveles)->with('aulas',$aulas);

    }


    //muestra la lista de grupos del periodo seleccionado 
    public function show(Request $request) 
    {
        $data = request()->validate([
            'periodo' => 'required'
        ]);
      

        $grupos = DB::table('grupos')
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        ->leftJoin('personas','personas.curp','=','docentes.curp_docente')
        ->whereNull('grupos.deleted_at')
        ->where('periodos.id_periodo','=',$data['periodo'])
        ->paginate(25);


        $niveles = Nivel::select('*')
        ->get();

        $p = Periodo::select('*')
        ->where('id_periodo',$data['periodo'])
        ->get();
        
        
        $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
        ->select('aulas.*','horas_disponibles.*')
        ->get();
// dd($grupos, $niveles, $p, $aulas, $data);
        return view('inscripciones.inscripciones',compact('grupos','niveles','p','aulas'))->with('success','lbioekls');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $grupo)
    {
        
        $estatusAlumno = Alumno::find($id)
                  ->update([
                      'estatus' => 'No Inscrito'
                  ]);
                //   dd($estatusAlumno);
        $alumnoInscrito = Inscripcion::where('num_control',$id)
                          ->where('id_grupo',$grupo)
                          ->get();

        $boleta = Boleta::where('num_control',$id)
                  ->where('id_grupo',$grupo)
                  ->get();

        

        $alumnoInscrito[0]->delete();
        $boleta[0]->delete();
    }
}
