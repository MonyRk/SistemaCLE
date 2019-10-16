<?php

namespace App\Http\Controllers;

use App\Docente;
use App\EvaluacionDocente;
use App\Grupo;
use App\GrupoRespuesta;
use App\Periodo;
use App\Pregunta;
use App\Respuesta;
use App\ResultadoPregunta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illum

class EvaluacionDocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $periodos = Periodo::get();
        $usuarioactual = \Auth::user();
        return view('evaluacionDocente.periodoEvaluacion',compact('periodos','usuarioactual'));
    }
    public function show()
    { 
        
        $usuarioactual = \Auth::user();
        $periodo = request('periodo');
        $grupoRs = GrupoRespuesta::select('*')->distinct()->get();
        $tipoPregunta = Pregunta::select('tipo')->distinct()->get();
        $enfoque = Pregunta::where('tipo','Enfoque de Enseñanza')
                            ->where('vigencia','>=',date("Y"))->get();
        $clima = Pregunta::where('tipo','Clima Afectivo')
                            ->where('vigencia','>=',date("Y"))->get();
        $enseñanzas = Pregunta::where('tipo','Proceso de Enseñanza')
                                ->where('vigencia','>=',date("Y"))->get();
        $retroalimentacion = Pregunta::where('tipo','Estrategias de Retroalimentacion')
                                    ->where('vigencia','>=',date("Y"))->get();

        return view('evaluacionDocente.evaluacion',compact('usuarioactual','clima','enfoque','enseñanzas','tipoPregunta','retroalimentacion','grupoRs','periodo'));
    }

    /**
     * Guardar evaluaciones realizadas
     */
    public function store(Request $request)
    {
        $data = request()->all();
        $total_preguntas = count($data)-5;
        // dd($data,$total_preguntas);
        $usuarioactual = \Auth::user();
        
        $estudiante = User::where('users.id',$usuarioactual->id)
                            ->leftjoin('alumnos','alumnos.curp_alumno','=','users.curp_user')
                            ->get();
        $docente = Docente::where('docentes.id_docente',$data['docente'])
                        ->select('docentes.curp_docente')
                        ->get();

        $evaluacion = EvaluacionDocente::where('num_control',$estudiante[0]->num_control)
                                        ->where('grupo',$data['grupo'])
                                        ->where('periodo',$data['periodo'])
                                        ->get();
        if ($evaluacion->isEmpty()) {
            $agregar_evaluacion = EvaluacionDocente::create([
                'num_control' => $estudiante[0]->num_control,
                'curp_docente' => $docente[0]->curp_docente,
                'grupo' => $data['grupo'],
                'periodo' => $data['periodo']
            ]);
            
            for ($i=1; $i < $total_preguntas+1 ; $i++) { 
                $arreglopregunta = $data['preg-res'.$i];
                ResultadoPregunta::create([
                    'id_pregunta' => $arreglopregunta[0],
                    'id_respuesta' => $arreglopregunta[1],
                    'num_evaluacion' => $agregar_evaluacion['num_evaluacion'],
                ]);
            }
            return redirect()->route('periodoEvaluacion')->with('success','Tus respuestas se han enviado correctamente.');
        } else {
            return  redirect()->route('periodoEvaluacion')->with('warning','Ya has realizado la Evaluación Docente de este periodo');
        }
    }

    public function periodoResultados()
    {
        $periodos = Periodo::get();
        $usuarioactual = \Auth::user();
        $docentes = Docente::leftjoin('personas','personas.curp','=','docentes.curp_docente')
                            ->whereNull('personas.deleted_at')                    
                            ->get();
        return view('evaluacionDocente.periodoResultados',compact('periodos','usuarioactual','docentes'));
    }

    public function resultados()    
    {
        $usuarioactual = \Auth::user();
        $preguntas = Pregunta::whereNull('deleted_at')->get();
        $respuestas = Respuesta::get(); 
        $total_preguntas = count(Pregunta::whereNull('deleted_at')->get()); 
        $total_respuestas = count(Respuesta::get());
        if ($usuarioactual->tipo != 'coordinador') {
            $data = request()->validate([
                'periodo' => 'required'
            ]);
// dd($usuarioactual->curp_user);
            $usuario= Docente::where('docentes.curp_docente',$usuarioactual->curp_user)
                                    ->leftjoin('users','users.curp_user','=','docentes.curp_docente')
                                    ->get(); 
            $resultados_evaluacion = ResultadoPregunta::leftjoin('evaluacion','evaluacion.num_evaluacion','=','resultado_pregunta.num_evaluacion')
                                    ->leftjoin('docentes','docentes.curp_docente','=','evaluacion.curp_docente')
                                    ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
                                    ->leftjoin('periodos','periodos.id_periodo','=','evaluacion.periodo')
                                    ->leftjoin('respuestas','respuestas.id_respuesta','=','resultado_pregunta.id_respuesta')
                                    ->leftjoin('preguntas','preguntas.id_pregunta','=','resultado_pregunta.id_pregunta')
                                    ->where('evaluacion.periodo',$data['periodo'])
                                    ->where('docentes.id_docente',$usuario[0]->id_docente)
                                    ->select('evaluacion.*','resultado_pregunta.*','preguntas.*','docentes.curp_docente','docentes.id_docente',
                                            'personas.nombres','personas.ap_paterno','personas.ap_materno','periodos.*','respuestas.*')
                                    // ->groupBy('preguntas.id_pregunta')
                                         ->get();
          
            $datos_pregunta[] = "";          
            foreach ($preguntas as $pregunta) {
                for ($i=0; $i < $total_respuestas; $i++) {
                    $id_respuesta = $respuestas[$i]->id_respuesta; //echo('respuesta:'.$id_respuesta.'pregunta'.$pregunta->id_pregunta.',');
                    $pregunta_respuesta = EvaluacionDocente::where('evaluacion.periodo',$data['periodo'])
                        ->where('evaluacion.curp_docente',$usuarioactual->curp_user)
                        ->leftjoin('resultado_pregunta','resultado_pregunta.num_evaluacion','=','evaluacion.num_evaluacion')
                        ->where('resultado_pregunta.id_pregunta',$pregunta->id_pregunta)
                        ->where('resultado_pregunta.id_respuesta',$id_respuesta)
                        ->get();
                        // dd($id_respuesta, count($pregunta_respuesta));
                    $datos_pregunta[$pregunta->id_pregunta] = [$id_respuesta,count($pregunta_respuesta)];
                    print_r($datos_pregunta);
                    echo(' - ') ;
                }
                // echo('pregutna');
            }
           dd('fin');           
        } else {
            $data = request()->validate([
                'periodo' => 'required',
                'docente' => 'required'
            ]);

            $resultadoss = ResultadoPregunta::leftjoin('evaluacion','evaluacion.num_evaluacion','=','resultado_pregunta.num_evaluacion')
                                    // ->leftjoin('docentes','docentes.curp_docente','=','evaluacion.curp_docente')
                                    // ->leftjoin('personas','personas.curp','=','evaluacion.curp_docente')
                                    // ->leftjoin('periodos','periodos.id_periodo','=','evaluacion.periodo')
                                    ->leftjoin('respuestas','respuestas.id_respuesta','=','resultado_pregunta.id_respuesta')
                                    ->leftjoin('preguntas','preguntas.id_pregunta','=','resultado_pregunta.id_pregunta')
                                    ->where('evaluacion.periodo',$data['periodo'])
                                    // ->where('evaluacion.curp_docente',$data['docente'])
                                    // ->where('docentes.id_docente',$data['docente'])
                                    ->select('evaluacion.*','resultado_pregunta.id_pregunta','resultado_pregunta.id_respuesta','resultado_pregunta.id_rp','preguntas.pregunta',
                                            'preguntas.vigencia','preguntas.tipo',//'docentes.curp_docente','docentes.id_docente',
                                            'respuestas.respuesta','respuestas.grupo_respuesta');
                                    // ->groupBy('preguntas.id_pregunta')
                                    // ->get();

            //CUENTA CUANTAS VECES RESPONDIERON CON UNA RESPUESTA CADA PREGUNTA
            //FUNCIONA
            /*$preguntas = Pregunta::pluck('id_pregunta');
            $respuestas =Respuesta::pluck('id_respuesta');
             $k = 0; 
            for ($i=0; $i < count($preguntas); $i++) { 
                for ($j=0; $j < count($respuestas); $j++) { 
                    $resultados[$k] = count(ResultadoPregunta::where('id_respuesta',$respuestas[$j])
                                                    ->where('id_pregunta',$preguntas[$i]) 
                                                    ->get());
                    $k++;
                }
            }*/
            $docente = Docente::where('curp_docente',$data['docente'])
                        ->leftjoin('personas','personas.curp','=','docentes.curp_docente')->get();
            $datos_pregunta = Pregunta::get();
            $datos_respuesta = Respuesta::get();
            $periodo = Periodo::where('id_periodo',$data['periodo'])->get();

            $preguntas = Pregunta::pluck('id_pregunta');
            $respuestas =Respuesta::pluck('id_respuesta');
             $k = 0; 
            //  $resultados="";
            for ($i=0; $i < count($preguntas); $i++) { 
                for ($j=0; $j < count($respuestas); $j++) { 
                    $resultados[$k] = count(ResultadoPregunta::leftjoin('evaluacion','evaluacion.num_evaluacion','=','resultado_pregunta.num_evaluacion')
                                                    ->where('evaluacion.periodo',$data['periodo'])
                                                    ->where('id_respuesta',$respuestas[$j])
                                                    ->where('id_pregunta',$preguntas[$i]) 
                                                    ->get());
                                                    $k++;
                }
                
            }
            //   dd($resultados);
           

                // foreach ($resultados as $resultado) {
                //     $pregunta.$resultado->id_pregunta = 
                //     DB::table(DB::raw("({$resultados->toSql() }) as resultados"))
                //                     ->mergeBindings($resultados->getQuery()) 
                //                     ->where('resultados.id_pregunta',$resultado->id_pregunta)
                //                     ->select(DB::raw('count(*) as total'),'resultados.id_respuesta')
                //                     ->groupBy('resultados.id_respuesta')
                //                     ->get();
                //                     dd($pregunta.$resultado->id_pregunta);                }
                
// dd($resultados);
        // cuenta cuantas veces se repite la respuesta (si se agrupa por pregunta cuenta cuantas veces se repiten las preguntas)
            // $resultados_evaluacion = DB::table(DB::raw("({$resultados->toSql() }) as resultados"))
            //                         ->mergeBindings($resultados->getQuery()) 
            //                         ->select('resultados.pregunta',DB::raw('count(*) as total'),'resultados.id_respuesta')
            //                         ->groupBy('resultados.id_respuesta')
            //                         ->get();       
        }

        // $user_info = DB::table('usermetas')
        //          ->select('browser', DB::raw('count(*) as total'))
        //          ->groupBy('browser')
        //          ->get();
        

        if (sizeof($resultados) == 0) {
            return back()->with('error','No hay resultados de la Evaluación Docente del periodo seleccionado.');
        } else {
            // dd($resultados_evaluacion);
            return view('evaluacionDocente.resultados',compact('periodo','resultados','docente','datos_pregunta','datos_respuesta'));
        }
                                    
    }
}
