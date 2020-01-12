<?php

namespace App\Http\Controllers;
use App\Grupo;
use App\Nivel;
use App\Aula;
use App\Alumno;
use App\AlumnoInscrito;
use App\Boleta;
use App\Fechas;
use App\Persona;
use App\Periodo;
use App\HorasDisponible;
use App\Inscripcion;
use App\Historial;
use App\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class InscripcionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        $usuarioactual = \Auth::user();
        $periodos = DB::table('periodos')->orderBy('anio','DESC')->orderBy('descripcion','ASC')->get();
        
        return view('inscripciones.periodoInscripciones',compact('periodos','usuarioactual'));
        
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
                    ->orWhere('grupos_periodos.nombres','like','%'.$search['buscar'].'%')           
                    ->orWhere('grupos_periodos.hora','like','%'.$search['buscar'].'%')
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
        $usuarioactual = \Auth::user();
        $usuario = User::select('docentes.id_docente')
        ->where('users.id',$usuarioactual->id)
        ->leftjoin('docentes','docentes.curp_docente','=','users.curp_user')->get();
        $periodo_actual = Periodo::where('actual',true)->get();

        $fecha_inscripciones = Fechas::where('proceso','inscripciones')->first();
        return view('inscripciones.inscripciones',compact('grupos','niveles','p','aulas','fecha_inscripciones','usuarioactual','periodo_actual'));   
        // return view ('inscripciones.inscripciones',compact('grupos','niveles','aulas','p','docentes','fecha_inscripciones'));
    }
    
    //buscar por estudiante en el grupo a inscribir
    public function searchE(Request $request)
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

        $periodo_actual = Periodo::where('actual',true)->get();
        // $periodo_actual = Periodo::where('id_periodo',$grupo[0]->periodo)->get(); 
        // $nivel_del_grupo = $grupo[0]->nivel;
        // $modulo_del_grupo = $grupo[0]->modulo;
        $curso = $grupo[0]->nivel.$grupo[0]->modulo;

        $alumnos_en_el_grupo = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
        ->leftjoin('alumno_inscrito','alumnos.num_control','=','alumno_inscrito.num_control')
        ->leftjoin('grupos','alumno_inscrito.id_grupo','=','grupos.id_grupo')
        ->whereNull('personas.deleted_at')
        ->whereNull('alumno_inscrito.deleted_at')
        ->where('alumno_inscrito.id_grupo',$id)
        ->get();
        // dd($curso);
       

        if ($curso == 'A1M1') {
       
            $aprobados = Inscripcion::where('alumno_inscrito.pago_verificado',true)
                                ->leftjoin('alumnos','alumno_inscrito.num_control','=','alumnos.num_control')
                                ->leftjoin('historial','historial.num_control','=','alumnos.num_control')
                                ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                                ->whereNull('alumnos.deleted_at')
                                ->where('alumnos.estatus','like','%No Inscrito%')
                                ->whereNull('alumno_inscrito.id_grupo')
                                ->whereNull('historial.A1M1')
                                ->orWhere('historial.A1M1','reprobado')
                                // ->orWhere('historial.A1M1','cursando')
                                ->whereNull('historial.grupo')
                                // ->where('alumnos.nivel_inicial',NULL)
                                // ->where('alumno_inscrito.periodo_pago',$periodo_actual[0]->id_periodo)
                                ->select('alumno_inscrito.num_control','personas.nombres','personas.ap_paterno','personas.ap_materno','alumno_inscrito.num_inscripcion')
                                
                                ->get();
                                // dd($aprobado);
 
        };
        // dd($aprobados);
        if ($curso == 'A2M1') {
            $aprobados = Inscripcion::where('pago_verificado',true)
                                        ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                        ->leftjoin('historial','historial.num_control','=','alumno_inscrito.num_control')
                                        ->whereNull('alumno_inscrito.id_grupo')
                                        ->where('historial.A1M1','aprobado')
                                        ->whereNull('historial.A2M2')
                                        ->whereNull('historial.grupo')
                                        ->orWhere('historial.A2M1','reprobado')
                                        // ->orWhere('historial.A2M1','cursando')
                                        ->where('alumnos.estatus','like','%No Inscrito%')
                                        ->where('pago_verificado',true)
                                        ->get();

        };
        
        if ($curso == 'A2M2') {
            $aprobados = Inscripcion::where('pago_verificado',true)
                                    ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                    ->leftjoin('historial','historial.num_control','=','alumno_inscrito.num_control')
                                    ->where('historial.A2M1','aprobado')
                                    ->whereNull('alumno_inscrito.id_grupo')
                                    ->whereNull('historial.B1M1')
                                    ->whereNull('historial.grupo')
                                    ->orWhere('historial.A2M2','reprobado')
                                    // ->orWhere('historial.A2M2','cursando')
                                    ->where('alumnos.estatus','like','%No Inscrito%')
                                    ->where('pago_verificado',true)
                                    ->get();
        };
        if ($curso == 'B1M1') {
            $aprobados = Inscripcion::where('pago_verificado',true)
                                    ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                    ->leftjoin('historial','historial.num_control','=','alumno_inscrito.num_control')
                                    ->where('historial.A2M2','aprobado')
                                    ->whereNull('alumno_inscrito.id_grupo')
                                    ->whereNull('historial.B1M2')
                                    ->whereNull('historial.grupo')
                                    ->orWhere('historial.B1M1','reprobado')
                                    // ->orWhere('historial.B1M1','cursando')
                                    ->where('alumnos.estatus','like','%No Inscrito%')
                                    ->where('pago_verificado',true)
                                    ->get(); 
        };
        if ($curso == 'B1M2') {
            $aprobados = Inscripcion::where('pago_verificado',true)
                                    ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                    ->leftjoin('historial','historial.num_control','=','alumno_inscrito.num_control')
                                    ->where('historial.B1M1','aprobado')
                                    ->whereNull('alumno_inscrito.id_grupo')
                                    ->whereNull('historial.grupo')
                                    ->orWhere('historial.B1M2','reprobado')
                                    // ->orWhere('historial.B1M2','cursando')
                                    ->where('alumnos.estatus','like','%No Inscrito%')
                                    ->where('pago_verificado',true)
                                    ->get();
        };



       return view('inscripciones.listaGrupo',compact('grupo','aprobados','alumnos_en_el_grupo','periodo_actual'));
    }

   
    public function store(Request $request)
    {
        $data = request()->all();
        $grupo = Grupo::where('id_grupo',$data['grupo'])
                        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                        ->leftjoin('nivels','grupos.nivel_id','=','nivels.id_nivel')
                        ->get();

        $nivel = $grupo[0]->nivel.$grupo[0]->modulo;
                        
        //cuenta cuantos estudiantes estaran en el grupo
        $totalEstudiantes = Inscripcion::where('id_grupo',$data['grupo'])->count();
        if(request()->has('inscribir')){
            $totalEstudiantes += count(request()->input('inscribir'));
            $arrayInscribir = request()->input('inscribir');
            // $this->verificar($arrayInscribir,$data['periodo'],$data['grupo']);
        }
        // if (request()->has('quitar')) {
        //     $totalEstudiantes -= count(request()->input('quitar'));
        //     $arrayQuitar = request()->input('quitar');
        // }

         
        // dependiendo del cupo se agregan o no los estudiantes seleccionados
        if ($totalEstudiantes <= $data['cupo']) {
            if (request()->has('inscribir')) {
                    for ($i = 0; $i < count($arrayInscribir); $i++){
                        
                        // Inscripcion::firstOrCreate([
                        //     'id_grupo' => $data['grupo'],
                        //     'num_control' => $arrayInscribir[$i]
                        // ]);

                        $inscribir = Inscripcion::where('num_control',$arrayInscribir[$i])
                                                ->whereNull('id_grupo')
                                                ->get();

                        $inscribir[0]->id_grupo = $data['grupo'];
                        $inscribir[0]->save();
        
                        Alumno::find($arrayInscribir[$i])
                        ->update([
                            'estatus' => 'Inscrito'
                        ]);
        
                        Boleta::firstOrCreate([
                            'id_grupo' => $data['grupo'],
                            'num_control' => $arrayInscribir[$i]
                        ]);

                        $historial = Historial::where('num_control',$arrayInscribir[$i])->get();
                        // dd($historial);
                        if ($historial->isNotEmpty()) {
                            $historial[0]->grupo = $grupo[0]->grupo;
                            $historial[0]->periodo = $grupo[0]->descripcion;
                            $historial[0]->anio = $grupo[0]->anio;
                            $historial[0]->nivel = $grupo[0]->nivel;
                            $historial[0]->modulo = $grupo[0]->modulo;
                            $historial[0]->$nivel = 'cursando';
                            $historial[0]->save();
                        }else{
                            $datos = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
                                    ->where('alumnos.num_control',$arrayInscribir[$i])
                                    ->select('personas.nombres','personas.ap_paterno','personas.ap_materno','alumnos.carrera','alumnos.semestre')->get();
                                    // dd($datos[0]->nombres);
                            Historial::create([
                                'num_control' => $arrayInscribir[$i],
                                'nombres' => $datos[0]->nombres,
                                'ap_paterno' => $datos[0]->ap_paterno,
                                'ap_materno' => $datos[0]->ap_materno,
                                'carrera' => $datos[0]->carrera,
                                'semestre' => $datos[0]->semestre,
                                'periodo' => $grupo[0]->descripcion,
                                'anio' => $grupo[0]->anio,
                                'nivel' => $grupo[0]->nivel,
                                'modulo' => $grupo[0]->modulo,
                                'grupo' => $grupo[0]->grupo,
                                $nivel => 'cursando'
                            ]);
                        }

                    }
            }
    
            // if (request()->has('quitar')) {
            //     for ($i = 0; $i < count($arrayQuitar); $i++){
            //         $this->destroy($arrayQuitar[$i],$data['grupo']);
            //     }
            // }
            
        }else{
            return back()->with('error','La cantidad de estudiantes es mayor al cupo del grupo');
            // return redirect()->route('inscribirEstudiantes',$data['grupo'])
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

       
        return back()->with('success','¡Los estudiantes se agregaron al grupo correctamente!')->with('p',$p)->with('grupos',$grupos)->with('niveles',$niveles)->with('aulas',$aulas);

    }

    
    //muestra la lista de grupos del periodo seleccionado 
    public function show(Request $request) 
    {
        $usuarioactual = \Auth::user();
        $usuario = User::select('docentes.id_docente')
        ->where('users.id',$usuarioactual->id)
        ->leftjoin('docentes','docentes.curp_docente','=','users.curp_user')->get();
        $periodo_actual = Periodo::where('actual',true)->get();
        $data = request()->validate([
            'periodo' => 'required'
        ]);
      
        if ($usuarioactual->tipo == 'docente') {
            $grupos = DB::table('grupos')
            ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
            ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
            ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
            ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
            ->leftJoin('personas','personas.curp','=','docentes.curp_docente')
            ->whereNull('grupos.deleted_at')
            ->where('grupos.docente',$usuario[0]->id_docente)
            ->where('periodos.id_periodo','=',$periodo_actual[0]->id_periodo)
            ->paginate(25);

            $p = Periodo::select('*')
                ->where('id_periodo',$periodo_actual[0]->id_periodo)
                ->get();
        } else {
            $grupos = DB::table('grupos')
            ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
            ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
            ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
            ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
            ->leftJoin('personas','personas.curp','=','docentes.curp_docente')
            ->whereNull('grupos.deleted_at')
            ->where('periodos.id_periodo','=',$data['periodo'])
            ->paginate(25);

            $p = Periodo::select('*')
                ->where('id_periodo',$data['periodo'])
                ->get();
            // $fecha_inscripciones = Fechas::where('proceso','inscripciones')->first();
        }
        
        $niveles = Nivel::select('*')
        ->get();

        $aulas = Aula::leftjoin('horas_disponibles','horas_disponibles.id_hora','=','aulas.hrdisponible')
        ->select('aulas.*','horas_disponibles.*')
        ->get();

        $fecha_inscripciones = Fechas::where('proceso','inscripciones')->first();
        // dd($fecha_inscripciones);
        if($grupos->isEmpty()){
            if($usuarioactual->tipo == 'docente'){
                return back()->with('error','No tienes grupos en el periodo seleccionado.');
            }else{
                return back()->with('error','No hay grupos en el periodo seleccionado.'); 
            }
        }else {
            return view('inscripciones.inscripciones',compact('grupos','niveles','p','aulas','fecha_inscripciones','usuarioactual','periodo_actual'));
        }

        
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

        $historiald = Historial::where('num_control',$id)->get();

        $alumnoInscrito[0]->id_grupo = NULL;
        $alumnoInscrito[0]->save();

        $boleta[0]->delete();

        $historiald[0]->grupo = NULL;
        $historiald[0]->periodo = NULL;
        $historiald[0]->anio = NULL;
        $historiald[0]->nivel = NULL;
        $historiald[0]->modulo = NULL;
        $historiald[0]->save();
    }

    public function getCursos()
    {
        return view('cursos.buscarCursos');
    }

    public function avance()
    {
        $usuarioactual = \Auth::user();

        $data = request()->validate([
            'numControl' => array('required','regex:/^[A-Z]{1}\d{8}|\d{8}$/')
            ]);

        $periodo_actual = Periodo::where('actual',true)->get();
        if ($usuarioactual->tipo == 'coordinador') {
            $estudiante = Alumno::where('num_control',$data['numControl'])
            ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
            ->get();

            $cursado = Historial::where('num_control',$data['numControl'])->get();
            
        } else {
            $sesion_actual = User::where('users.id',$usuarioactual->id)
                                    ->leftjoin('alumnos','alumnos.curp_alumno','=','users.curp_user')
                                    ->get();
            $estudiante = Alumno::where('num_control',$sesion_actual[0]->num_control)
            ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
            ->get();

            $cursado = Historial::where('num_control',$sesion_actual[0]->num_control)->get();
        }
        
        

        if ($cursado->isEmpty()) {
            return back()->with('error','No se han encontrado cursos del Estudiante');
        } 
        $grupo_inscrito = Inscripcion::where('alumno_inscrito.num_control',$cursado[0]->num_control)
                        ->where('alumno_inscrito.periodo_pago',$periodo_actual[0]->id_periodo)
                        // ->whereNotNull('alumno_inscrito.id_grupo')
                        ->leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
                        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
                        ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
                        ->orderByDesc('alumno_inscrito.updated_at')
                        // ->select('alumno_inscrito.updated_at','alumno_inscrito.id_grupo')
                        ->first();
                        
                        // ->get();
                        // dd($grupo_inscrito);
        // if ($grupo_inscrito == null) {
        //     dd('hay nada');
        // }
        // else{
            return view('cursos.avance',compact('estudiante','cursado','grupo_inscrito'));
        // }
        
    }

    public function mostrarExamenes(){
        $periodo_actual = Periodo::where('actual',true)->get();
        $alumnos_ubicados = Alumno::whereNotNull('nivel_inicial')
                ->where('periodo_examen',$periodo_actual[0]->id_periodo)
                ->whereNull('examen_verificado')
                ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                ->get();
        if ($alumnos_ubicados->isEmpty()) {
            return back()->with('warning','No hay alumnos registrados con examenes de ubicacion para el periodo actual.');
        } else {
            return view('cursos.verificarExamen',compact('alumnos_ubicados','periodo_actual'));
        }
        
    }

    public function verificarExamenes(){
        $data = request()->all();
        if (request()->has('verificado')) {
            foreach ($data['verificado'] as $verificado) {
                Alumno::where('num_control',$verificado)
                        ->update([
                            'examen_verificado' => true
                        ]);
            }
    
            return back()->with('success','¡Se han verificado correctamente los examenes registrados!');
        } else {
            return back()->with('warning','No seleccionaste ningún registro de examen para verificar');
        }
        
        
    }

    public function indexPago()
    {
        return view('pagos.indexpago');
    }

    public function agregarPago(){
        
        $data = request()->validate([
            'numControl' => array('required','regex:/^[A-Z]{1}\d{8}|\d{8}$/'),
            'folio' => 'required|digits_between:4,8|unique:alumno_inscrito,folio_pago',
            'monto' => 'required|numeric',
            'date' => 'required|date_format:d/m/Y'
        ]);
        $periodo_actual = Periodo::where('actual',true)->get();
        // se busca si estan los datos del alumno
        $alumno = Alumno::find($data['numControl']); 
        if ($alumno==null) {
            //si no esta regresa un mensaje de informacion
            return redirect()->route('indexpagos')->with('error','El Estudiante no se encuentra registrado.');
        }else{
            //si esta registrado busca si ya ha realizado un pago 
            $inscrito = Inscripcion::where('num_control',$data['numControl'])->get();

            // si no ha hecho ningun pago crea uno nuevo
            if($inscrito->isEmpty()){
                Inscripcion::create([
                    'num_control' => $data['numControl'],
                    'folio_pago' => $data['folio'],
                    'monto_pago' => $data['monto'],
                    'fecha' => $data['date'],
                    'periodo_pago' => $periodo_actual[0]->id_periodo
                ]);
            }else{
                //si ya hizo alguno se verifica si alguno de esos pagos no ha sido verificado y no ha sido tomado para inscripcion
                $actualizar = Inscripcion::where('num_control',$data['numControl'])
                                // ->whereNull('folio_pago')
                                ->whereNull('id_grupo')
                                ->whereNull('pago_verificado')
                                ->orderBy('updated_at','DESC')
                                ->get();
                                // dd($actualizar);
                //si los pagos ya han sido verificado y ya se tomaron para inscripcion entonces se crea uno nuevo
                if ($actualizar->isEmpty()) {
                    Inscripcion::create([
                        'num_control' => $data['numControl'],
                        'folio_pago' => $data['folio'],
                        'monto_pago' => $data['monto'],
                        'fecha' => $data['date'],
                        'periodo_pago' => $periodo_actual[0]->id_periodo
                        // 'pago_verificado' => true
                    ]);
                    // return back()->with('warning','Ya se ha registrado un pago, verifique la información.');
                                                    //Ya has registrado un pago ya puedes acceder a las inscripciones
                } else {
                    return back()->with('warning','Ya se ha registrado un pago, verifique la información.');
                                                    //Ya has registrado un pago ya puedes acceder a las inscripciones
                    // $actualizar[0]->folio_pago = $data['folio'];
                    // $actualizar[0]->monto_pago = $data['monto'];
                    // $actualizar[0]->fecha = $data['date'];
                    // // $actualizar[0]->pago_verificado = true;
                    // $actualizar[0]->save();
                }
            
            
            }
            return back()->with('success','¡Se agregó el pago del estudiante!');
        }
    }

    public function buscarPago()
    {
        $usuarioactual = \Auth::user();

        $data = request()->all();
        if ($usuarioactual->tipo == 'coordinador') {
            $inscrito = Inscripcion::where('alumno_inscrito.num_control',$data['numControl'])
                    ->get(); 
            $numero_control = $data['numControl'];
        } else {
            $num_control = Alumno::where('curp_alumno',$usuarioactual->curp_user)->select('num_control')->get();
            $inscrito = Inscripcion::where('alumno_inscrito.num_control',$num_control[0]->num_control)
                    ->get();
            $numero_control =  $num_control[0]->num_control;
        }
        //bien bien bien
        if ($inscrito->isNotEmpty()) {
            
            $pagos = Inscripcion::where('alumno_inscrito.num_control',$numero_control)
                    ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                    ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                    ->select('personas.nombres','personas.ap_paterno','personas.ap_materno','alumnos.num_control',
                            'alumno_inscrito.folio_pago','alumno_inscrito.monto_pago','alumno_inscrito.fecha',
                            'alumno_inscrito.num_inscripcion','alumno_inscrito.pago_verificado','alumno_inscrito.updated_at')
                    ->whereNotNull('folio_pago')
                    ->orderBy('alumno_inscrito.updated_at','DESC')
                    // ->whereNull('alumno_inscrito.pago_verificado')
                    // ->orWhere('alumno_inscrito.pago_verificado',false)
                    ->get();

                if ($pagos->isEmpty()) {
                    if ($usuarioactual->tipo == 'coordinador') {
                        return redirect()->route('verificarPagos')->with('warning','No se encontraron pagos sin verificar de este estudiante');
                    }else{
                        return back()->with('warning','No se encontraron pagos tuyos sin verificar');
                    }
                }
                // dd($pagos);
                return view('pagos.pagos',compact('pagos')); 
        }else{
           if ($usuarioactual->tipo == 'coordinador') {
                return redirect()->route('verificarPagos')->with('warning','No se encontraron pagos realizados de este estudiante');
           }else{
                return back()->with('warning','No hemos encontraron pagos realizados por ti.');
           }
        }      
        
    }

    public function guardarVerificados(){

        $data = request()->all();
        foreach ($data['verificado'] as $verificar) {
           $a = Inscripcion::find($verificar);
           $a->pago_verificado = true;
           $a->save();
        }
        return redirect()->route('verificarPagos')->with('success','El pago se verificó exitosamente!.');
        
    }

    public function getLista($id){

        $alumnos_en_el_grupo = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
        ->leftjoin('alumno_inscrito','alumnos.num_control','=','alumno_inscrito.num_control')
        ->leftjoin('grupos','alumno_inscrito.id_grupo','=','grupos.id_grupo')
        ->whereNull('personas.deleted_at')
        ->whereNull('alumno_inscrito.deleted_at')
        ->where('alumno_inscrito.id_grupo',$id)
        ->get();

        $datosGrupo = Grupo::where('grupos.id_grupo',$id)
                            ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                            ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                            ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                            ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
                            ->leftjoin('personas','docentes.curp_docente','=','personas.curp')
                            ->get();
        // dd($datosGrupo);
        if($alumnos_en_el_grupo->isEmpty()){
            return back()->with('error','El grupo no tiene ningún estudiante inscrito.');
        }else{
            
        $pdfLista =  PDF::setPaper('A4','landscape')->loadView('pdf.listaGrupo',compact('alumnos_en_el_grupo','datosGrupo'));

        return $pdfLista->download('ListaGrupo-'.$alumnos_en_el_grupo[0]->grupo.'-'.strftime("%b%Y").'.pdf');
        }

    }


    public function inscripcionAlumno(Alumno $alumno){
        $estatus_inscripciones = Fechas::where('proceso','inscripciones')->first();
        $email_alumno = User::where('curp_user',$alumno->curp_alumno)->first();
        if ($email_alumno->email != null) {
            if($estatus_inscripciones !=null && Carbon::now() >= $estatus_inscripciones->fecha_inicio && Carbon::now() <= $estatus_inscripciones->fecha_fin)
            { 
                
                $periodo_actual = Periodo::where('actual',true)->get();
                
                //verifico si ya realizo el pago 
                $pago = Inscripcion::where('num_control',$alumno->num_control)
                            ->where('pago_verificado',true)
                            ->whereNull('id_grupo')
                            ->whereNull('deleted_at')
                            ->where('periodo_pago',$periodo_actual[0]->id_periodo)
                            ->get(); 
                
                if($pago->isNotEmpty()){
                //busco el nivel del estudiante
                    $estudiante = Historial::where('historial.num_control',$alumno->num_control)
                                                ->get();
                    if($estudiante[0]->A1M1 == null || $estudiante[0]->A1M1 == 'reprobado'){
                        $nivel_estudiante = 'A1';
                        $modulo_estudiante = 'M1';
                    }
                    if( $estudiante[0]->A2M1 == 'reprobado' || $estudiante[0]->A2M1 == null  && $estudiante[0]->A1M1 == 'aprobado'){
                        $nivel_estudiante = 'A2';
                        $modulo_estudiante = 'M1';
                    }
                    if( $estudiante[0]->A2M2 == 'reprobado' || $estudiante[0]->A2M2 == null  && $estudiante[0]->A2M1 == 'aprobado'){
                        $nivel_estudiante = 'A2';
                        $modulo_estudiante = 'M2';
                    }
                    if( $estudiante[0]->B1M1 == 'reprobado' || $estudiante[0]->B1M1 == null  && $estudiante[0]->A2M2 == 'aprobado'){
                        $nivel_estudiante = 'B1';
                        $modulo_estudiante = 'M1';
                    }
                    if($estudiante[0]->B1M2 == 'reprobado' || $estudiante[0]->B1M2 == null  && $estudiante[0]->B1M1 == 'aprobado'){
                        $nivel_estudiante = 'B1';
                        $modulo_estudiante = 'M2';
                    }
                    // selecciono los grupos en el periodo seleccionado y el nivel al que se puede inscribir el estudiante
                    $grupos = Grupo::leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                                        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
                                        ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
                                        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                                        ->whereNull('grupos.deleted_at')
                                        ->where('nivels.nivel',$nivel_estudiante)
                                        ->where('nivels.modulo',$modulo_estudiante)
                                        ->where('grupos.periodo',$periodo_actual[0]->id_periodo)
                                        ->leftjoin('periodos','grupos.periodo','=','periodos.id_periodo')
                                        ->select('grupos.*','nivels.*','aulas.*','docentes.curp_docente','personas.nombres','personas.ap_paterno','personas.ap_materno','periodos.*')
                                        ->get();
                                
                    return view('inscripciones.inscripcionAlumno',compact('nivel_estudiante','modulo_estudiante','grupos'));
                }else{
                    return back()->with('error','Realiza el pago o verifica en la coordinación que tu pago se haya validado y que actualmente no estes inscrito en otro grupo.');
                
                }
            }else {
                return redirect()->route('sinAcceso')->with('info','El proceso de inscripciones aún no esta disponible. Consulta las fechas en la Coordinación de Lenguas Extranjeras.');
            }
        } else {
            return back()->with('info','Debes registrar un correo electronico para inscribirte.');
        }
        
    }

    public function agregarAlumno(){
        $data = request()->all();
        if (request()->has('grupo')) {
            $usuarioactual = \Auth::user();
            $estudiante = User::where('users.id',$usuarioactual->id)
                                ->leftjoin('alumnos','alumnos.curp_alumno','=','users.curp_user')
                                ->get();
            $cupo = Grupo::find($data['grupo']);
            $verificar_cupo = Inscripcion::where('id_grupo',$data['grupo'])->whereNull('deleted_at')->count();
            
            if ($verificar_cupo <= $cupo->cupo) {
                //se inscribe a un grupo
                $inscribir = Inscripcion::where('alumno_inscrito.num_control',$estudiante[0]->num_control)
                            ->whereNull('id_grupo')
                            ->get();
                            // dd($inscribir);
                $inscribir[0]->id_grupo = $data['grupo'];
                
                $inscribir[0]->save();

                //se actualiza la informacion del alumno y se cambia a inscrito
                Alumno::find($estudiante[0]->num_control)
                        ->update([
                            'estatus' => 'Inscrito'
                        ]);

                //se crea la boleta del estudiante
                Boleta::firstOrCreate([
                    'id_grupo' => $data['grupo'],
                    'num_control' => $estudiante[0]->num_control
                ]);
                
                //se almacenan los datos en historial
                $grupo = Grupo::where('id_grupo',$data['grupo'])
                        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                        ->leftjoin('nivels','grupos.nivel_id','=','nivels.id_nivel')
                        ->get();

                $nivel = $grupo[0]->nivel.$grupo[0]->modulo;

                $historial = Historial::where('num_control',$estudiante[0]->num_control)->get();
                        // dd($historial);
                        if ($historial->isNotEmpty()) {
                            $historial[0]->grupo = $grupo[0]->grupo;
                            $historial[0]->periodo = $grupo[0]->descripcion;
                            $historial[0]->anio = $grupo[0]->anio;
                            $historial[0]->nivel = $grupo[0]->nivel;
                            $historial[0]->modulo = $grupo[0]->modulo;
                            $historial[0]->$nivel = 'cursando';
                            $historial[0]->save();
                        }else{
                            $datos = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
                                    ->where('alumnos.num_control',$estudiante[0]->num_control)
                                    ->select('personas.nombres','personas.ap_paterno','personas.ap_materno','alumnos.carrera','alumnos.semestre')->get();
                                    // dd($datos[0]->nombres);
                            Historial::create([
                                'num_control' => $estudiante[0]->num_control,
                                'nombres' => $datos[0]->nombres,
                                'ap_paterno' => $datos[0]->ap_paterno,
                                'ap_materno' => $datos[0]->ap_materno,
                                'carrera' => $datos[0]->carrera,
                                'semestre' => $datos[0]->semestre,
                                'periodo' => $grupo[0]->descripcion,
                                'anio' => $grupo[0]->anio,
                                'nivel' => $grupo[0]->nivel,
                                'modulo' => $grupo[0]->modulo,
                                'grupo' => $grupo[0]->grupo,
                                $nivel => 'cursando'
                            ]);
                        }
                return redirect()->route('periodoinscripciones')->with('success','¡Te has inscrito al grupo!');

            } else {
                return back()->with('error','Al parecer ya no hay espacios en este grupo. Intenta inscribirte en otro grupo.');
            }

        }else {
            return back()->with('warning','Debes seleccionar el grupo al que deseas inscribirte.');
        }
    }

    public function fechas(){
        
        $data = request()->validate([
            'inicio' => 'required|date_format:d-m-Y|date_after',
            'fin' => 'required|date_format:d-m-Y|after_or_equal:inicio',
        ]);
        $periodo_actual = Periodo::where('actual',true)->get();
        
        $fechas = Fechas::updateOrCreate([
            'proceso' => 'inscripciones'
        ],[
            'fecha_inicio' => $data['inicio'],
            'fecha_fin' => $data['fin'],
            'periodo' => $periodo_actual[0]->id_periodo
        ]);
        

        return back()->with('success','¡Las fechas de inscripciones se guardaron correctamente!');
    }

    public function quitarEstudiante($grupo)
    { 
        $grupo = DB::table('grupos')
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->where('id_grupo',$grupo)
        ->get();

        $periodo_actual = Periodo::where('actual',true)->get();
        // $periodo_actual = Periodo::where('id_periodo',$grupo[0]->periodo)->get(); 
        // $nivel_del_grupo = $grupo[0]->nivel;
        // $modulo_del_grupo = $grupo[0]->modulo;
        $curso = $grupo[0]->nivel.$grupo[0]->modulo;

        $alumnos_en_el_grupo = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
        ->leftjoin('alumno_inscrito','alumnos.num_control','=','alumno_inscrito.num_control')
        ->leftjoin('grupos','alumno_inscrito.id_grupo','=','grupos.id_grupo')
        ->whereNull('personas.deleted_at')
        ->whereNull('alumno_inscrito.deleted_at')
        ->where('alumno_inscrito.id_grupo',$grupo[0]->id_grupo)
        ->get();
        return view('inscripciones.listaQuitar',compact('grupo','periodo_actual','curso','alumnos_en_el_grupo'));
    }

    public function modificar(){
        $data = request()->all();
        $grupo = Grupo::where('id_grupo',$data['grupo'])
                        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                        ->leftjoin('nivels','grupos.nivel_id','=','nivels.id_nivel')
                        ->get();

        $nivel = $grupo[0]->nivel.$grupo[0]->modulo;
                        
        //cuenta cuantos estudiantes estan en el grupo
        $totalEstudiantes = Inscripcion::where('id_grupo',$data['grupo'])->count();
        
        if (request()->has('quitar')) {
            $totalEstudiantes -= count(request()->input('quitar'));
            $arrayQuitar = request()->input('quitar');
            for ($i = 0; $i < count($arrayQuitar); $i++){
                $this->destroy($arrayQuitar[$i],$data['grupo']);
            }
        }

        return back()->with('success','La lista se modificó correctamente.');

    }

}
