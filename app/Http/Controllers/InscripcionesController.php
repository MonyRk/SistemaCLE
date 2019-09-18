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
        $grupo = DB::table('grupos')
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->where('id_grupo',$id)
        ->get();

        $periodo_actual = Periodo::where('id_periodo',$grupo[0]->periodo)->get(); 
        $nivel_del_grupo = $grupo[0]->nivel;
        $modulo_del_grupo = $grupo[0]->modulo;

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
        
        // $alumnos =  
            // DB::select('select * from alumnos where deleted_at is NULL and num_control not in 
            //             (SELECT num_control FROM alumno_inscrito WHERE deleted_at IS NULL) ');

        // $this->validar($nivel_del_grupo,$modulo_del_grupo,$periodo_actual);

       return view('inscripciones.listaGrupo',compact('grupo','alumnos','alumnos_en_el_grupo'))->with('success','probando');
    }


    // verifica si el alumno aprobo o reprobo el curso anterior o si presento examen de ubicacion
    public function validar($nivel,$modulo,$periodo_actual)
    {
    //     if ($nivel == "A1") {
    //         // 
    //         $cursos = Inscripcion::select('num_control')
    //                 ->whereNull('deleted_at')
    //                 ->get();

    //         $alumnos = Alumno::select('*')
    //                 ->whereNull('personas.deleted_at')
    //                 ->whereNotIn('num_control',$cursos)
    //                 ->leftJoin('personas','alumnos.curp_alumno','=','personas.curp')
    //                 ->where('alumnos.estatus','like','%No Inscrito')
    //                 ->get();
                   
    //         // reprobados
                        
    //     }

    //     if ($nivel == "A2" && $modulo == "M1") {  

    //         if($periodo_actual[0]->descripcion == "ENE-JUN" ){ 
    //             $invierno = Periodo::where('descripcion',"Invierno")->where('anio',(date("Y")-1))->get();

    //             if($invierno->isEmpty()){
    //                 $reprobados = Boleta::leftJoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
    //                             ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
    //                             ->where('periodos.descripcion',"AGO-DIC")
    //                             ->where('periodos.anio',(date("Y")-1))
    //                             ->where('boletas.calif_f','<', 70)
    //                             ->get();
                        
    //             }else{
    //                 $reprobados = Boleta::leftJoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
    //                             ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
    //                             ->where('periodos.descripcion',"AGO-DIC")
    //                             ->where('periodos.anio',(date("Y")-1))
    //                             ->where('periodos.descripcion',"Invierno")
    //                             ->where('periodos.anio',(date("Y")-1))
    //                             ->where('boletas.calif_f','<', 70)
    //                             ->get(); 
    //             }
    //         }


    //         if($periodo_actual[0]->descripcion == "AGO-DIC"){
    //             $reprobados = Boleta::leftJoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
    //             ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
    //             ->where('periodos.descripcion',"ENE-DIC")
    //             ->where('periodos.anio',date("Y"))
    //             ->get();
    //         }
            
            
    //         dd($reprobados);          
    //     }
        
    //     return 'hola';
    }


   
    public function store(Request $request)
    {
        $data = request()->all(); 
        //cuenta cuantos estudiantes estaran en el grupo
        $totalEstudiantes = Inscripcion::where('id_grupo',$data['grupo'])->count();
        if(request()->has('inscribir')){
            $totalEstudiantes += count(request()->input('inscribir'));
            $arrayInscribir = request()->input('inscribir');
            // $this->verificar($arrayInscribir,$data['periodo'],$data['grupo']);
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

        return view('inscripciones.inscripciones',compact('grupos','niveles','p','aulas'))->with('success','lbioekls');
    }


    public function destroy($id, $grupo)
    {
        
        $estatusAlumno = Alumno::find($id)
                  ->update([
                      'estatus' => 'No Inscrito'
                  ]);
                  
        $alumnoInscrito = Inscripcion::where('num_control',$id)
                          ->where('id_grupo',$grupo)
                          ->get();

        $boleta = Boleta::where('num_control',$id)
                  ->where('id_grupo',$grupo)
                  ->get();

        

        $alumnoInscrito[0]->delete();
        $boleta[0]->delete();
    }

    public function getCursos()
    {
        return view('cursos.buscarCursos');
    }

    public function avance()
    {
        $data = request()->all();

        $estudiante = Alumno::where('num_control',$data['numero'])
                            ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                            ->get();
        $cursado = Boleta::where('num_control',$data['numero'])
                                    ->leftjoin('grupos','boletas.id_grupo','=','grupos.id_grupo')
                                    ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                                    ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                                    ->get();

                                        // dd($cursos_del_alumno);
        return view('cursos.avance',compact('estudiante','cursado'));
    }

    public function indexPago()
    {
        return view('pagos.iniciopagos');
    }

    public function pago()
    {
        $data = request()->all();

        // $datos 
        return view('pagos.pagos');
    }





}
