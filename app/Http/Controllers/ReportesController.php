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
use Illuminate\Support\Facades\DB;

use App\Exports\UsersExport;
use App\Membrete;
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
        $niveless = Nivel::get();
        foreach ($niveless as $nivel) {
            $grupos_semanales[] = Grupo::where('modalidad','Semanal')
                    ->where('nivel_id',$nivel->id_nivel)
                    ->where('periodo',$data['periodo'])
                    ->count();
        }
        
        foreach ($niveless as $nivel) {
            $grupos_sabatinos[] = Grupo::where('modalidad','Sabatino')
                    ->where('nivel_id',$nivel->id_nivel)
                    ->where('periodo',$data['periodo'])
                    ->count();
        }

        return view('reportes.estadisticas.estadisticas',compact('periodo','data','carreras','generos','niveles','aprobados','reprobados','ingresos','grupos_semanales','grupos_sabatinos'));
    }

    public function liberaciones(){
        $data = request()->validate(
            ['liberacion' => 'required']
        );
        // $membrete = Membrete::get();
        // dd($membrete);
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
        $membrete = Membrete::get();

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
                $formato = NumFormato::first();
                $formato->num = $formato->num+1;
                $formato->save();
                // return view('pdf.liberacionClePdf',compact('datosEstudiante','nivel','plan','membrete'));
                    $pdfLista =  PDF::loadView('pdf.liberacionClePdf',compact('datosEstudiante','nivel','plan','membrete'));
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
        $membrete = Membrete::get();
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
            $pdfLista =  PDF::loadView('pdf.liberacionCertificacionPdf',compact('datosEstudiante','nivel','puntos','plan','certificacion','membrete'));
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
        $membrete = Membrete::get();
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
            $pdfLista =  PDF::loadView('pdf.liberacion4pdf',compact('datosEstudiante','nivel','plan','membrete'));
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
        $data = request()->all();
        // dd($data);
        $niveless = Nivel::get();
        foreach ($niveless as $nivel) {
            $grupos_semanales[] = Grupo::where('modalidad','Semanal')
                    ->where('nivel_id',$nivel->id_nivel)
                    ->where('periodo',$data['periodo'])
                    ->count();
        }
        
        foreach ($niveless as $nivel) {
            $grupos_sabatinos[] = Grupo::where('modalidad','Sabatino')
                    ->where('nivel_id',$nivel->id_nivel)
                    ->where('periodo',$data['periodo'])
                    ->count();
        }
        
        $estudiantes = 
         DB::table("grupos")
         ->where('periodo',$data['periodo'])
	    ->select(DB::raw("SUM(cupo) as num_estudiantes"))
	    ->groupBy(DB::raw("nivel_id"))
        ->get();

        //PARA CONTAR LA CANTIDAD DE ESTUDIANTES INSCRITOS POR NIVEL (SE HACE DESPUES DE LAS INSCRIPCIONES)
        // foreach ($niveless as $nivel) {
        //     $estudiantes[] = Inscripcion::leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')            
        //     ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        //     ->where('grupos.periodo',$data['periodo'])
        //     ->where('grupos.nivel_id',$nivel->id_nivel)
        //     ->count();
        // }
        
        $periodo = Periodo::where('id_periodo',$data['periodo'])->get();
        $membrete = Membrete::get();
        // return view('pdf.estadisticapdf',compact('grupos_semanales','grupos_sabatinos','estudiantes','membrete','periodo','niveless'));
        $pdf = PDF::setPaper('A4','landscape')->loadView('pdf.estadisticapdf',compact('grupos_semanales','grupos_sabatinos','estudiantes','membrete','periodo','niveless'));
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

    public function membrete(){
        $membrete = Membrete::get();
        return view('reportes.membretes.membrete',compact('membrete'));

    }



}
