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
use App\Historial;
use Barryvdh\DomPDF\Facade as PDF;
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

        $periodo_actual = Periodo::where('id_periodo',$grupo[0]->periodo)->get(); 
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
        //    $alumnos =  Alumno::leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
        //                     ->whereNull('personas.deleted_at');

            // $historiala = Historial::select('num_control')->whereNull('A1M1')->get();

    
            // DB::select('select * from alumnos where personas.deleted_at is NULL and where alumnos.num_control not in (SELECT num_control FROM historial) leftjoin personas on alumnos.curp_alumnos = personas.curp');
            // verificados esta bien
            // $verificados = Inscripcion::where('alumno_inscrito.pago_verificado',true)
            //                     ->leftjoin('alumnos','alumno_inscrito.num_control','=','alumnos.num_control')
            //                     ->whereNull('alumnos.deleted_at')
            //                     ->where('alumnos.estatus','like','%No Inscrito%')
            //                     // ->where('alumnos.nivel_inicial',NULL)
            //                     ->select('alumno_inscrito.num_control')
            //                     ->get();


            $aprobados = Inscripcion::where('alumno_inscrito.pago_verificado',true)
                                ->leftjoin('alumnos','alumno_inscrito.num_control','=','alumnos.num_control')
                                ->leftjoin('historial','historial.num_control','=','alumnos.num_control')
                                ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                                ->whereNull('alumnos.deleted_at')
                                ->where('alumnos.estatus','like','%No Inscrito%')
                                ->whereNull('historial.A1M1')
                                // ->where('alumnos.nivel_inicial',NULL)
                                ->select('alumno_inscrito.num_control','personas.nombres','personas.ap_paterno','personas.ap_materno')
                                ->get();
                                // dd($aprobado);

            // $aprobados = $verificados->whereIn($aprobado,$verificados);
            // $aprobados = $verificados->whereNotIn('alumno_inscrito.num_control',$historiala);
            //                        $aprobados=$aprobados1->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
            //                         ->leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
            //                         ->select('alumno_inscrito.num_control','persona.nombres','persona.ap_paterno','persona.ap_materno');
            
                                // dd($verificados);       
        };
        //hacer una subconsulta de todos los alumnos que no esten inscritos y de esos ver los que estan en historial
        //que hayan aprobado el curso anterior, los que reprobaron y los que inician en ese nivel(cursando)
        if ($curso == 'A2M1') {
            $aprobados = Inscripcion::where('pago_verificado',true)
                                        ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                        ->leftjoin('historial','historial.num_control','=','alumno_inscrito.num_control')
                                        ->where('historial.A1M1','aprobado')
                                        ->whereNull('historial.A2M2')
                                        ->whereNull('historial.grupo')
                                        ->orWhere('historial.A2M1','reprobado')
                                        ->orWhere('historial.A2M1','cursando')
                                        ->where('alumnos.estatus','like','%No Inscrito%')
                                        ->get();

            // $aprobados = Historial::leftjoin('alumnos','alumnos.num_control','=','historial.num_control')
            //                         ->leftjoin('alumno_inscrito','alumnos.num_control','=','alumno_inscrito.num_control')
            //                         ->where('alumno_inscrito.pago_verificado',true)
            //                         ->where('historial.A1M1','aprobado')
            //                         ->whereNull('historial.A2M2')
            //                         ->whereNull('historial.grupo')
            //                         ->orWhere('historial.A2M1','reprobado')
            //                         ->orWhere('historial.A2M1','cursando')
            //                         ->where('alumnos.estatus','like','%No Inscrito%')
            //                         ->get(); 

            // $aprobados1= DB::table(DB::raw("({$alumnos->toSql() }) as a"))
            //                         ->mergeBindings($alumnos->getQuery())
            //                         ->leftJoin('alumno_inscrito','alumno_inscrito.num_control','=','a.num_control')
            //                         ->get();
        // dd( $aprobados );
        };
        //componer los 
        if ($curso == 'A2M2') {
            $aprobados = Inscripcion::where('pago_verificado',true)
                                    ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                    ->leftjoin('historial','historial.num_control','=','alumno_inscrito.num_control')
                                    ->where('historial.A2M1','aprobado')
                                    ->whereNull('historial.B1M1')
                                    ->whereNull('historial.grupo')
                                    ->orWhere('historial.A2M2','reprobado')
                                    ->orWhere('historial.A2M2','cursando')
                                    ->where('alumnos.estatus','like','%No Inscrito%')
                                    ->get();
        };
        if ($curso == 'B1M1') {
            $aprobados = Inscripcion::where('pago_verificado',true)
                                    ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                    ->leftjoin('historial','historial.num_control','=','alumno_inscrito.num_control')
                                    ->where('historial.A2M2','aprobado')
                                    ->whereNull('historial.B1M2')
                                    ->whereNull('historial.grupo')
                                    ->orWhere('historial.B1M1','reprobado')
                                    ->orWhere('historial.B1M1','cursando')
                                    ->where('alumnos.estatus','like','%No Inscrito%')
                                    ->get(); 
        };
        if ($curso == 'B1M2') {
            $aprobados = Inscripcion::where('pago_verificado',true)
                                    ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                    ->leftjoin('historial','historial.num_control','=','alumno_inscrito.num_control')
                                    ->where('historial.B1M1','aprobado')
                                    ->whereNull('historial.grupo')
                                    ->orWhere('historial.B1M2','reprobado')
                                    ->orWhere('historial.B1M2','cursando')
                                    ->where('alumnos.estatus','like','%No Inscrito%')
                                    ->get();
        };



// dd($aprobados);

        /*primeros pasos no estan bien, los dejo por si acaso */
        /*mostrar todos los alumnos a inscribir*/
        // $alumnos = Alumno::leftjoin('personas','alumnos.curp_alumno','=','personas.curp')
        // ->whereNull('personas.deleted_at')
        // ->where('alumnos.estatus','No Inscrito')
        // ->get();
        
       /* consulta para ver los alumnos que no estan eliminados y que su numero de control no esta en 
        la tabla de alumno inscrito*/
        // $alumnos =  
            // DB::select('select * from alumnos where deleted_at is NULL and num_control not in 
            //             (SELECT num_control FROM alumno_inscrito WHERE deleted_at IS NULL) ');

            /*manda a llamar el metodo para validar*/
        // $this->validar($nivel_del_grupo,$modulo_del_grupo,$periodo_actual);


       return view('inscripciones.listaGrupo',compact('grupo','aprobados','alumnos_en_el_grupo'))->with('success','probando');
    }

   
    public function store(Request $request)
    {
        $data = request()->all();
        $grupo = Grupo::where('id_grupo',$data['grupo'])
                        ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                        ->leftjoin('nivels','grupos.nivel_id','=','nivels.id_nivel')
                        ->get();

        $nivel = $grupo[0]->nivel.$grupo[0]->modulo;
                        // dd($grupo);
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
    
            if (request()->has('quitar')) {
                for ($i = 0; $i < count($arrayQuitar); $i++){
                    $this->destroy($arrayQuitar[$i],$data['grupo']);
                }
            }
            
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

        // return redirect()->route('inscripciones')
        //                 ->with('p',$p)->with('grupos',$grupos)
        //                 ->with('niveles',$niveles)->with('aulas',$aulas)
        //                 ->with('success','¡Los estudiantes se agregaron al grupo correctamente!');
        return back()->with('success','¡Los estudiantes se agregaron al grupo correctamente!')->with('p',$p)->with('grupos',$grupos)->with('niveles',$niveles)->with('aulas',$aulas);

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
        $data = request()->all();

        $estudiante = Alumno::where('num_control',$data['numero'])
                            ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                            ->get();
        // $cursado = Boleta::where('num_control',$data['numero'])
        //                             ->leftjoin('grupos','boletas.id_grupo','=','grupos.id_grupo')
        //                             ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        //                             ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        //                             ->get();

        $cursado = Historial::where('num_control',$data['numero'])->get();

        if ($cursado->isEmpty()) {
            return redirect()->route('cursos')->with('error','No se han encontrado cursos del Estudiante');
        }

        // dd($cursado);
        return view('cursos.avance',compact('estudiante','cursado'));
    }

    public function indexPago()
    {
        return view('pagos.indexpago');
    }

    public function agregarPago(){

        $data = request()->validate([
            'numControl' => array('required','regex:/^[A-Z]{1}\d{8}|\d{8}$/'),
            'folio' => 'required|numeric',
            'monto' => 'required|numeric',
            'date' => 'required|date'
        ]);
        
        $alumno = Alumno::find($data['numControl']);
        if ($alumno==null) {
            return redirect()->route('indexpagos')->with('error','El Estudiante no se encuentra registrado.');
        }else{

            $inscrito = Inscripcion::where('num_control',$data['numControl'])->get();
            
            if($inscrito->isEmpty()){
                Inscripcion::create([
                    'num_control' => $data['numControl'],
                    'folio_pago' => $data['folio'],
                    'monto_pago' => $data['monto'],
                    'fecha' => $data['date'],
                    'pago_verificado' => true
                ]);
            }

            $actualizar = Inscripcion::where('num_control',$data['numControl'])
                            ->whereNull('folio_pago')
                            ->orderBy('updated_at','DESC')
                            ->get();

            $actualizar[0]->folio_pago = $data['folio'];
            $actualizar[0]->monto_pago = $data['monto'];
            $actualizar[0]->fecha = $data['date'];
            $actualizar[0]->pago_verificado = true;
            $actualizar[0]->save();
 
            return redirect()->route('indexpagos')->with('success','Se agregó el pago al Estudiante.');
        }
    }

    public function buscarPago()
    {
        $data = request()->all();

        $inscrito = Inscripcion::where('alumno_inscrito.num_control',$data['numControl'])
                    ->get(); 

        if ($inscrito->isNotEmpty()) {
            
            $pagos = Inscripcion::where('alumno_inscrito.num_control',$data['numControl'])
                    ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                    ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                    ->select('personas.nombres','personas.ap_paterno','personas.ap_materno','alumnos.num_control',
                            'alumno_inscrito.folio_pago','alumno_inscrito.monto_pago','alumno_inscrito.fecha','alumno_inscrito.num_inscripcion')
                    ->whereNotNull('folio_pago')
                    ->whereNull('alumno_inscrito.pago_verificado')
                    ->orWhere('alumno_inscrito.pago_verificado',false)
                    ->get();
                // dd($pagos);
                if ($pagos->isEmpty()) {
                    return redirect()->route('verificarPagos')->with('warning','No se encontraron pagos realizados de este estudiante');
                }
                return view('pagos.pagos',compact('pagos')); 
        }else{
            return redirect()->route('verificarPagos')->with('warning','No se encontraron pagos realizados de este estudiante');
        }      
        
    }

    public function guardarVerificados(){
        // dd(request()->all());

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


}
