<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Docente;
use App\EvaluacionDocente;
use App\Fechas;
use App\Grupo;
use App\GrupoRespuesta;
use App\Inscripcion;
use App\Periodo;
use App\Pregunta;
use App\Respuesta;
use App\ResultadoPregunta;
use App\User;
use Carbon\Carbon;
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
        $estatus_evaluacion = Fechas::where('proceso','evaluacion')->first();
        
        if ($usuarioactual->tipo == 'coordinador') {
            return $this->preguntasEvaluacion();
        }else{
            if($estatus_evaluacion !=null && Carbon::now() >= $estatus_evaluacion->fecha_inicio && Carbon::now() <= $estatus_evaluacion->fecha_fin)
            {
                return $this->preguntasEvaluacion();
            }else{
                return redirect()->route('sinAcceso')->with('info','El proceso de Evaluación Docente aún no esta disponible. Consulta las fechas en la Coordinación de Lenguas Extranjeras.');
            }
        }
    }
 

    public function preguntasEvaluacion (){
        $usuarioactual = \Auth::user();

        $periodo = request('periodo');
        if($usuarioactual->tipo == 'alumno'){
            $alumno = Alumno::where('curp_alumno',$usuarioactual->curp_user)->first();
            $buscar_inscripcion = Inscripcion::where('num_control',$alumno->num_control)
                                        ->where('periodo_pago',$periodo)
                                        ->whereNotNull('id_grupo')
                                        ->orderByDesc('updated_at')
                                        ->get();
                                        // dd($buscar_inscripcion);
            if($buscar_inscripcion->isEmpty()){
                return back()->with('warning','No puedes realizar la evaluación, no estas inscrito en algun grupo. Verifica tu información en la Coordinación.');
            }
            
        }
        $fecha_evaluacion = Fechas::where('proceso','evaluacion')->first();

        
        
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

        return view('evaluacionDocente.evaluacion',compact('usuarioactual','clima','enfoque','enseñanzas','tipoPregunta','retroalimentacion','grupoRs','periodo','fecha_evaluacion'));
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
        if ($usuarioactual->tipo != 'coordinador') {
            $data = request()->validate([
                'periodo' => 'required'
            ]);
            // dd($usuarioactual);
            $existeEvaluacion = EvaluacionDocente::where('periodo',$data['periodo'])
                        ->where('curp_docente',$usuarioactual->curp_user)->get();
            
            if ($existeEvaluacion->isEmpty()) {
                return back()->with('error','No hay resultados de la Evaluación Docente del periodo seleccionado.');
            } else {
                $docente = Docente::where('curp_docente',$usuarioactual->curp_user)
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
                return view('evaluacionDocente.resultados',compact('periodo','resultados','docente','datos_pregunta','datos_respuesta'));
            }           
        } else {
            $data = request()->validate([
                'periodo' => 'required',
                'docente' => 'required'
            ]);

            $existeEvaluacion = EvaluacionDocente::where('periodo',$data['periodo'])
                                                ->where('curp_docente',$data['docente'])->get();
                                                // dd($existeEvaluacion);
            if ($existeEvaluacion->isEmpty()) {
                return back()->with('error','No hay resultados de la Evaluación Docente del periodo seleccionado.');
            } else {
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
                return view('evaluacionDocente.resultados',compact('periodo','resultados','docente','datos_pregunta','datos_respuesta'));
            }
        }                           
    }

    public function fechas(){
        $data = request()->validate([
            'inicio' => 'required|date_format:d-m-Y|date_after',
            'fin' => 'required|date_format:d-m-Y|after_or_equal:inicio',
        ]);
        $periodo_actual = Periodo::where('actual',true)->get();
        
        $fechas = Fechas::updateOrCreate([
            'proceso' => 'evaluacion'
        ],[
            'fecha_inicio' => $data['inicio'],
            'fecha_fin' => $data['fin'],
            'periodo' => $periodo_actual[0]->id_periodo
        ]);
        

        return back()->with('success','¡Las fechas para la Evaluación Docente se guardaron correctamente!');
    
    }
    
}
