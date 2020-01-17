<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\Inscripcion;
use App\Periodo;
use App\Historial;
use App\Alumno;
use App\Boleta;
use App\Docente;
use App\Nivel;
use App\NumFormato;
use NumerosEnLetras;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Spatie\DbDumper\Databases\MySql as Dumper;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $periodos = Periodo::get();
        return view('reportes.estadisticas.periodoEstadisticas',compact('periodos'));
    }

    public function graficas(){
        $data= request()->all();
        $periodo = Periodo::where('id_periodo',$data['periodo'])->get();

        $carreras = array('Ingeniería Eléctrica','Ingeniería Electrónica','Ingeniería Civil','Ingeniería Mecánica',
        'Ingeniería Industrial','Ingeniería Química','Ingeniería en Gestión Empresarial','Ingeniería en Sistemas Computacionales',
        'Licenciatura en Administración');
        for ($i=0; $i < count($carreras); $i++) { 
            $carreras[$i] =count( Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
            ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
            ->where('grupos.periodo',$data['periodo'])
            ->whereNull('alumno_inscrito.deleted_at')
            ->select('grupos.periodo','grupos.id_grupo','alumno_inscrito.*','alumnos.carrera')
            ->where('alumnos.carrera',$carreras[$i])->get());
        }

        $generos = array('F','M');
        for ($i=0; $i < 2;  $i++) { 
            $generos[$i] = count(Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
            ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
            ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
            ->where('grupos.periodo',$data['periodo'])
            ->whereNull('alumno_inscrito.deleted_at')
            ->select('grupos.periodo','grupos.id_grupo','alumno_inscrito.*','personas.sexo')
            ->where('personas.sexo',$generos[$i])->get());
        }
        $generos = $generos[0].','.$generos[1];

        $niveles = array("A1","A2","A2","B1","B1");
        $modulos = array("M1","M1","M2","M1","M2");
        for ($i=0; $i < count($niveles); $i++) { 
            $niveles[$i] = count(
                Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')            
                ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                ->where('grupos.periodo',$data['periodo'])
                ->select('grupos.periodo','grupos.id_grupo','alumno_inscrito.*','nivels.nivel','nivels.modulo')
                ->where('nivels.nivel',$niveles[$i])
                ->where('nivels.modulo',$modulos[$i])
                ->get()
            );
        }

         
            $aprobados = count(
                Boleta::leftjoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
                ->where('grupos.periodo',$data['periodo'])
                ->where('boletas.calif_f','>',69)
                ->get());
            $reprobados = count(
                Boleta::leftjoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
                ->where('grupos.periodo',$data['periodo'])
                ->where('boletas.calif_f','<',70)
                ->get());
            
        $ingresos = count(Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
                        ->where('grupos.periodo',$data['periodo'])
                        ->where('alumno_inscrito.pago_verificado',true)
                        ->get());
        // dd($aprobados,$reprobados);
        return view('reportes.estadisticas.estadisticas',compact('periodo','data','carreras','generos','niveles','aprobados','reprobados','ingresos'));
    }

    public function liberaciones(){
        $data = request()->validate(
            ['liberacion' => 'required']
        );

        if($data['liberacion']=='cle'){
            return view('reportes.constancias.liberacionesCle');
        }
        if($data['liberacion']=='certificacion'){
            return view('reportes.constancias.liberacionesCertificacion');
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
// dd($datosEstudiante[0]->$nivel,$nivel);
        if ($datosEstudiante->isEmpty()) {
            return back()->with('error','No se encontraron datos del estudiante');
        }
         else {
           if($datosEstudiante[0]->$nivel == 'aprobado'){    
                if($nivel == 'A2M2'){$nivel = 'A2';}else{$nivel = 'B1';}
                $formato = NumFormato::first();
                $formato->num = $formato->num+1;
                $formato->save();
                // return view('pdf.liberacionClePdf',compact('datosEstudiante','nivel','plan'));
                    $pdfLista =  PDF::loadView('pdf.liberacionClePdf',compact('datosEstudiante','nivel','plan'));
                    return $pdfLista->download($datosEstudiante[0]->num_control.'-Liberacion-'.strftime("%b%Y").'.pdf');   
           }else {
               return back()->with('warning','La liberación del estudiante aun no se puede generar, verifique las calificaciones');
           }
        }
        
        
    }


    public function liberacionCertificacion(){
        $data = request()->validate([
            'numControl' => array('required','regex:/^[A-Z]{1}\d{8}|\d{8}$/'),
            'certificacion' => 'required|alpha_spaces',
            'puntos' => 'required|numeric',
            'plan' => 'required',
            'nivel' => 'required'
        ]);
        $nivel = $data['nivel'];
        $puntos = $data['puntos'];
        $plan = $data['plan'];
        $certificacion = $data['certificacion'];
        $datosEstudiante = Alumno::where('alumnos.num_control',$data['numControl'])                            
        ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
        ->get();
        if ($datosEstudiante->isEmpty()) {
            return back()->with('error','No se encontraron datos del estudiante, verifica los datos y vuelve a intentarlo');
        }
         else {
            $formato = NumFormato::first();
            $formato->num = $formato->num+1;
            $formato->save();
            // return view('pdf.liberacionToeflPdf',compact('datosEstudiante','nivel','puntos','plan','toefl'));
            $pdfLista =  PDF::loadView('pdf.liberacionCertificacionPdf',compact('datosEstudiante','nivel','puntos','plan','certificacion'));
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
            $formato = NumFormato::first();
            $formato->num = $formato->num+1;
            $formato->save();
            $pdfLista =  PDF::loadView('pdf.liberacion4pdf',compact('datosEstudiante','nivel','plan'));
            return $pdfLista->download($datosEstudiante[0]->num_control.'-Liberacion-'.strftime("%b%Y").'.pdf');   
        }
    }

    public function docenteAdendum()
    {
        $docentes = Docente::leftjoin('personas','personas.curp','=','docentes.curp_docente')
                            ->whereNull('personas.deleted_at')
                            // ->where('docentes.estatus','Inactivo')
                            ->get();
        return view('reportes.acuerdosLaborales',compact('docentes'));
    }

    public function generarAdendum()
    {
        $data = request()->validate([
            'docente' => 'required',
            'idioma' => 'required|alpha_spaces',
            'nivel' => 'required',
            'rfc' => 'required|alpha_num',
            'titulo' => 'required|alpha_spaces',
            'importe' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'fecha_pago' => 'required'
        ]);

        $docente = Docente::where('docentes.id_docente',$data['docente'])
                        ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
                        ->get();
        //  return view('pdf.adendum',compact('docente','data'));
         $pdfLista =  PDF::loadView('pdf.adendum',compact('docente','data'));
         return $pdfLista->download($docente[0]->nombres.'-Adendum-'.strftime("%b%Y").'.pdf');   
    }

    public function generarEstadisticas(){
        $data= request()->all();
        // dd($data);
        $periodo = Periodo::where('id_periodo',$data['periodo'])->get();

        $nombre_carreras = array('Ingeniería Eléctrica','Ingeniería Electrónica','Ingeniería Civil','Ingeniería Mecánica',
        'Ingeniería Industrial','Ingeniería Química','Ingeniería en Gestión Empresarial','Ingeniería en Sistemas Computacionales',
        'Licenciatura en Administración');
        for ($i=0; $i < count($nombre_carreras); $i++) { 
            $carreras[$i] =count( Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
            ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
            ->where('grupos.periodo',$data['periodo'])
            ->whereNull('alumno_inscrito.deleted_at')
            ->select('grupos.periodo','grupos.id_grupo','alumno_inscrito.*','alumnos.carrera')
            ->where('alumnos.carrera',$nombre_carreras[$i])->get());
        }
// dd($carreras);
        $generos = array('F','M');
        for ($i=0; $i < 2;  $i++) { 
            $generos[$i] = count(Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
            ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
            ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
            ->where('grupos.periodo',$data['periodo'])
            ->whereNull('alumno_inscrito.deleted_at')
            ->select('grupos.periodo','grupos.id_grupo','alumno_inscrito.*','personas.sexo')
            ->where('personas.sexo',$generos[$i])->get());
        }
        $generos = $generos[0].','.$generos[1];

        $nombre_niveles = array("A1","A2","A2","B1","B1");
        $modulos = array("M1","M1","M2","M1","M2");
        for ($i=0; $i < count($nombre_niveles); $i++) { 
            $niveles[$i] = count(
                Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')            
                ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                ->where('grupos.periodo',$data['periodo'])
                ->select('grupos.periodo','grupos.id_grupo','alumno_inscrito.*','nivels.nivel','nivels.modulo')
                ->where('nivels.nivel',$nombre_niveles[$i])
                ->where('nivels.modulo',$modulos[$i])
                ->get()
            );
        }

            $aprobados = count(
                Boleta::leftjoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
                ->where('grupos.periodo',$data['periodo'])
                ->where('boletas.calif_f','>',69)
                ->get());
            $reprobados = count(
                Boleta::leftjoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
                ->where('grupos.periodo',$data['periodo'])
                ->where('boletas.calif_f','<',70)
                ->get());
            
        $ingresos = count(Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
                        ->where('grupos.periodo',$data['periodo'])
                        ->where('alumno_inscrito.pago_verificado',true)
                        ->get());
        // dd($aprobados,$reprobados);
        
        // return view('pdf.estadisticaspdf',compact('periodo','data','carreras','generos','niveles','aprobados','reprobados','ingresos'));
        // $pdfLista =  PDF::loadView('pdf.estadisticaspdf',compact('periodo','data','carreras','generos','niveles','aprobados','reprobados','ingresos'));
        // return $pdfLista->download('DatosEstadisticos-'.$periodo[0]->descripcion.'-'.$periodo[0]->anio.'.pdf');  
        
//         $pdf = PDFS::loadView('reportes.estadisticas.estadisticas',compact('periodo','data','carreras','generos','niveles','aprobados','reprobados','ingresos'))
//         ->setOption('images', true)
//         ->setOption('enable-javascript', true)
//         ->setOption('javascript-delay', 1000)
//         ->setOption('enable-smart-shrinking', true)
//         ->setOption('no-stop-slow-scripts', true)
//         ->setOption('viewport-size', '1024x1366' );

// return $pdf->download('pdf1.pdf');
        
        // dd($generos);
    //    return view('pdf.estadisticapdf',compact('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'));
    //    $pdfEstadisticos =  PDF::loadView('pdf.estadisticapdf',compact('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'));
    //     $pdfEstadisticos =  PDF::loadView('pdf.estadisticaspdf',compact('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'));
    //    return $pdfEstadisticos->stream('DatosEstadisticos-'.strftime("%b%Y").'.pdf');   
   

    //    PDF CON GRAFICAS

    //  intento con dompdf
    
// $array = array('pdf.estadisticaspdf',compact('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'));
// // instantiate and use the dompdf class
// $dompdf = new Dompdf();
// $dompdf->loadHtmlFile('/reportes/pdf');

// // (Optional) Setup the paper size and orientation
// // $dompdf->setPaper('A4', 'landscape');
// $dompdf->set_option('isHtml5ParserEnabled', true);
// // Render the HTML as PDF
// $dompdf->render();

// // Output the generated PDF to Browser
// $dompdf->stream();

//vistas para otros intentos con snappy
    // return view('pdf.estadisticapdf',compact('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'));

    // $dompdf = new PDF();
    // $dompdf->set_option('isHtml5ParserEnabled', true);
    // $dompdf->loadView('pdf.estadisticapdf',compact('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'));

    // // (Optional) Setup the paper size and orientation
    // // $dompdf->setPaper('Legal', 'landscape');
    
    // // Render the HTML as PDF
    // $dompdf->render();
    // //$dompdf->set_base_path('localhost/exampls/style.css');
    // // Output the generated PDF to file
    // file_put_contents('datos', $dompdf->output());

    // PARA EXCEL
    // return Excel::download(new EstadisticasExport('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'), 'DatosEstadisticos.xlsx');

    $pdf = PDF::loadView('pdf.estadisticapdf',compact('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'));

// $pdf->setOption('enable-javascript', true);
// $pdf->setOption('images', true);
// $pdf->setOption('javascript-delay', 5000);
// $pdf->setOption('enable-smart-shrinking', true);
// $pdf->setOption('no-stop-slow-scripts', true);
return $pdf->download('DatosEstadisticos-'.strftime("%b%Y").'.pdf');

    }


     
    
        public function export() 
        {
            return Excel::download(new EstadisticasExport('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'), 'DatosEstadisticos.xlsx');
        }
    



    public function backup(){
        Dumper::create()
            ->setDbName('sistem')
            ->setUserName('root')
            ->setPassword('Aldair_16')
            ->dumpToFile('respaldo.sql');
    }



}
