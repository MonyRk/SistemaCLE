<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\Inscripcion;
use App\Periodo;
use App\Historial;
use App\Alumno;
use NumerosEnLetras;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReportesController extends Controller
{
    public function index(){
        $periodos = Periodo::get();
        return view('reportes.estadisticas.periodoEstadisticas',compact('periodos'));
    }

    public function graficas(){
        // dd(request()->all());
        $periodos = Periodo::get();
        foreach ($periodos as $periodo ) {
            $grupos[$periodo->id_periodo] = Grupo::where('periodo',$periodo->id_periodo)->count();
            $alumnos[$periodo->id_periodo] = Inscripcion::leftjoin('grupos','alumno_inscrito.id_grupo','=','grupos.id_grupo')
                                                            ->where('periodo',$periodo->id_periodo)->count();
        }
        
        // dd($alumnos);
        return view('reportes.estadisticas.estadisticas',compact('periodos','grupos','alumnos'));
    }

    public function liberaciones(){
        $data = request()->validate(
            ['liberacion' => 'required']
        );

        if($data['liberacion']=='cle'){
            return view('reportes.constancias.liberacionesCle');
        }
        if($data['liberacion']=='toefl'){
            return view('reportes.constancias.liberacionesToefl');
        }
        if($data['liberacion']=='habilidades'){
            return view('reportes.constancias.liberaciones4');
        }
        return redirect()->route('reportes')->with('warning','Algo salió mal, por favor realice nuevamente el proceso');
    }

    public function liberacionCle(){
        $data = request()->validate([
            'numControl' => array('required','regex:/^[A-Z]{1}\d{8}|\d{8}$/'),
            'plan' => 'required',
            'nivel' => 'required'
        ]);
        $nivel = $data['nivel'];
        $plan = $data['plan']; 

        // dd(NumerosEnLetras::convertir(15));
        $datosEstudiante = Alumno::where('alumnos.num_control',$data['numControl'])
                                ->leftjoin('historial','alumnos.num_control','=','historial.num_control')                            
                                ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                                ->get();

        if ($datosEstudiante->isEmpty()) {
            return back()->with('error','No se encontraron datos del estudiante');
        }
         else {
           if($datosEstudiante[0]->$nivel == 'aprobado'){    
                if($nivel == 'A2M2'){$nivel = 'A2';}else{$nivel = 'B1';}
                // return view('pdf.liberacionClePdf',compact('datosEstudiante','nivel','plan'));
                    $pdfLista =  PDF::loadView('pdf.liberacionClePdf',compact('datosEstudiante','nivel','plan'));
                    return $pdfLista->download($datosEstudiante[0]->num_control.'-Liberacion-'.strftime("%b%Y").'.pdf');   
           }else {
               return back()->with('warning','La liberación del estudiante aun no se puede generar, verifique las calificaciones');
           }
        }
        
        
    }


    public function liberacionToefl(){
        $data = request()->validate([
            'numControl' => array('required','regex:/^[A-Z]{1}\d{8}|\d{8}$/'),
            'puntos' => 'required|numeric',
            'plan' => 'required',
            'nivel' => 'required'
        ]);
        $nivel = $data['nivel'];
        $puntos = $data['puntos'];
        $plan = $data['plan'];

        $datosEstudiante = Alumno::where('alumnos.num_control',$data['numControl'])                            
        ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
        ->get();
        if ($datosEstudiante->isEmpty()) {
            return back()->with('error','No se encontraron datos del estudiante');
        }
         else {
            $pdfLista =  PDF::loadView('pdf.liberacionToeflPdf',compact('datosEstudiante','nivel','puntos','plan'));
            return $pdfLista->download($datosEstudiante[0]->num_control.'-Liberacion-'.strftime("%b%Y").'.pdf');   
        }
    }

    public function liberacion4(){
        $data = request()->validate([
            'numControl' => array('required','regex:/^[A-Z]{1}\d{8}|\d{8}$/'),
            'plan' => 'required',
            'nivel' => 'required'
        ]);
        $nivel = $data['nivel'];
        $plan = $data['plan'];

        $datosEstudiante = Alumno::where('alumnos.num_control',$data['numControl'])                            
        ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
        ->get();
        if ($datosEstudiante->isEmpty()) {
            return back()->with('error','No se encontraron datos del estudiante');
        }
         else {
             
            $pdfLista =  PDF::loadView('pdf.liberacion4pdf',compact('datosEstudiante','nivel','plan'));
            return $pdfLista->download($datosEstudiante[0]->num_control.'-Liberacion-'.strftime("%b%Y").'.pdf');   
        }
    }
}
