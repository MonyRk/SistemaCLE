<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Boleta;
use App\Cambio;
use App\Grupo;
use App\Historial;
use App\Inscripcion;
use App\Membrete;
use App\Periodo;
use App\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BoletaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuarioactual = \Auth::user();
       
        if($usuarioactual->tipo != 'docente'){
            $periodos = DB::table('periodos')->orderBy('actual','DESC')->orderBy('anio','DESC')->orderBy('descripcion','ASC')->get();
        }else{
            $periodos = DB::table('periodos')->where('actual',true)->get();
        }

        $grupos = DB::table('grupos')->orderBy('grupo','ASC')->get();

        return view('boletas.boletas',compact('periodos','grupos','usuarioactual'));
    }

    public function show($grupo_periodo)
    {
        $usuarioactual = \Auth::user();

        if ($usuarioactual->tipo == 'alumno' ) {
            
            $data = request()->validate([
                'periodo' => 'required'
            ]);
            $usuario = User::where('users.id',$usuarioactual->id)
                            ->leftjoin('alumnos','alumnos.curp_alumno','=','users.curp_user')
                            ->get();

            //grupo del alumno que inicio sesión en el periodo seleccionado 
            $alumnos_inscritos = Boleta::where('boletas.num_control',$usuario[0]->num_control)
                                        ->where('grupos.periodo',$data['periodo'])
                                        ->leftjoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
                                        ->leftjoin('alumnos','alumnos.num_control','=','boletas.num_control')
                                        ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                                        // ->orderBy('alumnos.num_control')
                                        ->get();

            if ($alumnos_inscritos->isEmpty()) {
                return back()->with('error','No tienes datos correspondientes al periodo seleccionado');
            } 

            $infoGrupo = DB::table('grupos')
                            ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                            ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                            ->where('id_grupo',$alumnos_inscritos[0]->id_grupo)
                            ->get();
            
            
            // }else {
            //     return view('boletas.calificaciones',compact('infoGrupo','alumnos_inscritos','usuarioactual'));
            // }


        } else {
            $data = request()->validate(
                ['periodo' => 'required',
                'grupo' => 'required']
            );

            $infoGrupo = DB::table('grupos')
                        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                        ->where('id_grupo',$data['grupo'])
                        ->get();

            $alumnos_inscritos = Inscripcion::where('alumno_inscrito.id_grupo',$data['grupo'])
                                        ->leftJoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                        ->leftjoin('boletas','alumnos.num_control','=','boletas.num_control')
                                        ->leftJoin('personas','alumnos.curp_alumno','=','personas.curp')  
                                        ->where('boletas.id_grupo',$data['grupo']) 
                                        ->whereNull('boletas.deleted_at')
                                        ->orderBy('alumnos.num_control','ASC')  
                                        ->get();

        }

        if ($alumnos_inscritos->isEmpty()) {
            return back()->with('error','El grupo no tiene ningún estudiante');
            
        }else {
            return view('boletas.calificaciones',compact('infoGrupo','alumnos_inscritos','usuarioactual'));
        }
          

    }

  
    public function update(Request $request)
    {
        
        $data = request()->all();
        // dd(Carbon::now()->format('Y-m-d H:m:s'));
        $usuarioactual= \Auth::user();
        
        $total = count($data)-3;
        
        for ($i=0; $i < $total; $i++) { 
            $arregloCalif = $data['calif'.$i];
            if ($arregloCalif[4] < 9) {//si no tiene mas de 8 faltas
                $c_final = round(($arregloCalif[1]+$arregloCalif[2]+$arregloCalif[3])/3);
            } else{
                $c_final = 0;
            }
            $calificaciones_actuales =
            Boleta::where('num_control',$arregloCalif[0])
            ->where('id_grupo',$data['grupo'])->get();

            if ($arregloCalif[1] != $calificaciones_actuales[0]->calif1 && $arregloCalif[1] > 0
            ||$arregloCalif[2] != $calificaciones_actuales[0]->calif2 && $arregloCalif[2] > 0
            ||$arregloCalif[3] != $calificaciones_actuales[0]->calif3 && $arregloCalif[3] > 0) {
                Cambio::create([
                    'boleta' => $calificaciones_actuales[0]->id_boleta,
                    'calif1_previo' => $calificaciones_actuales[0]->calif1,
                    'calif1_nuevo' => $arregloCalif[1],
                    'calif2_previo' => $calificaciones_actuales[0]->calif2,
                    'calif2_nuevo' => $arregloCalif[2],
                    'calif3_previo' => $calificaciones_actuales[0]->calif3,
                    'calif3_nuevo' => $arregloCalif[3],
                    'usuario' => $usuarioactual->id,
                    'fecha' => Carbon::now()->format('Y-m-d'),
                    'hora' => Carbon::now()->format('H:m:s')
                    ]);
            }

            $actualizacion_boleta =
            Boleta::where('num_control',$arregloCalif[0])
                ->where('id_grupo',$data['grupo'])
                ->update([
                    'calif1' => $arregloCalif[1],
                    'calif2' => $arregloCalif[2],
                    'calif3' => $arregloCalif[3],
                    'faltas' => $arregloCalif[4],
                    'calif_f' => $c_final
                ]);
                ;
                // dd($calificaciones_actuales);
                // UPDATE `boletas` SET `calif1`=NULL,`calif2`=NULL,`calif3`=NULL,`calif_f`=NULL,`faltas`=NULL WHERE `id_grupo` = 11

            // $grupo = Grupo::where('grupos.id_grupo',$data['grupo'])
            //                 ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
            //                 ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
            //                 ->get(); 
                    
                    
            //ACTUALIZA EL HISTORIAL AL GENERAR EL ACTA DE CALIFICACIONES
            // $avance = Historial::where('historial.num_control',$arregloCalif[0])
            //                     ->where('historial.grupo',$grupo[0]->grupo)
            //                     ->where('historial.periodo',$grupo[0]->descripcion)
            //                     ->where('historial.anio',$grupo[0]->anio)
            //                     ->get();
            // $columna = $grupo[0]->nivel.$grupo[0]->modulo;
            // // dd($arregloCalif);
            // if ($arregloCalif[3]!=null && $arregloCalif[3]>0) { //si ya hay una calificacion del 3er parcial
            //     if ($c_final<70) { //si la calificacion final es menor a 70
            //         $avance[0]->$columna = 'reprobado';
            //         $avance[0]->save();
            //     }else{ // si la calificacion final es mayor = a 70
            //         $avance[0]->$columna = 'aprobado';
            //         $avance[0]->save();
            //     }
            // } else{
            //     $avance[0]->$columna = 'cursando';
            //     $avance[0]->save();
            // }
            
                               
            
        }//end for

        return back()->with('success','¡Las calificaciones se han actualizado correctamente!');
        
    }
    public function destroy(Boleta $boleta)
    {
        
    }

    
    public function getGrupos(Request $request)
    {         
        if($request->ajax()){ 
        
            $grupos = Grupo::where('periodo',$request->id_periodo)
                            ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
                        ->get();
            
                    foreach ($grupos as $grupo) {
                $gruposArray[$grupo->id_grupo] = array ($grupo->grupo.' - '.$grupo->nivel.$grupo->modulo);
            }
            return response()->json($gruposArray);
        }
    }

    public function getGruposDocente(Request $request)
    {         
        if($request->ajax()){ 
            
        $usuario = User::select('docentes.id_docente')
        ->where('users.id',\Auth::user()->id)
        ->leftjoin('docentes','docentes.curp_docente','=','users.curp_user')->get();
        $grupos = User::where('users.id',\Auth::user()->id)
                        ->where('grupos.periodo',$request->id_periodo)
                        ->leftjoin('docentes','docentes.curp_docente','=','users.curp_user')
                        ->leftjoin('grupos','grupos.docente','=','docentes.id_docente')
                        ->where('grupos.docente',$usuario[0]->id_docente)
                        ->get();
                    foreach ($grupos as $grupo) {
                $gruposArray[$grupo->id_grupo] = array ($grupo->grupo);
            }
            return response()->json($gruposArray);
        }
    }

    
    public function descargarBoleta($grupo,$alumno){
        
        $datosEstudiante = Alumno::where('alumnos.num_control',$alumno)
                                ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                                ->leftjoin('boletas','alumnos.num_control','=','boletas.num_control')
                                ->where('boletas.id_grupo',$grupo)
                                ->get();
        $datosGrupo = Grupo::where('grupos.id_grupo',$grupo)
                            ->leftjoin('nivels','grupos.nivel_id','=','nivels.id_nivel')
                            ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
                            ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
                            ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
                            ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
                            ->get();
        $membrete = Membrete::get();                            
                                    // return view('pdf.boletaspdf',compact('datosEstudiante','datosGrupo'));
        $pdfBoleta =  PDF::setPaper('A4','landscape')->loadView('pdf.boletaspdf',compact('datosEstudiante','datosGrupo','membrete'));
        return $pdfBoleta->download($alumno.'-Boleta-'.strftime("%b%Y").'.pdf');
    }

    public function generarActa($grupo){
        // $data = $grupo;
        $infoGrupo = Grupo::where('id_grupo',$grupo)
        ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        ->leftJoin('periodos','periodos.id_periodo','=','grupos.periodo')
        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
        ->leftjoin('personas','docentes.curp_docente','=','personas.curp')
        ->get();
        $membrete = Membrete::get();
        $nivelGrupo = $infoGrupo[0]->nivel.$infoGrupo[0]->modulo;

        $alumnos_inscritos = Inscripcion::where('alumno_inscrito.id_grupo',$grupo)
                                        ->leftJoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
                                        ->leftjoin('boletas','alumnos.num_control','=','boletas.num_control')
                                        ->leftJoin('personas','alumnos.curp_alumno','=','personas.curp')  
                                        ->where('boletas.id_grupo',$grupo) 
                                        ->whereNull('boletas.deleted_at')
                                        ->orderBy('personas.ap_paterno','ASC')  
                                        ->get();
                                        
        
        $this->actualizarHistoriales($alumnos_inscritos,$nivelGrupo,$infoGrupo[0]->id_grupo);               
        // return view('pdf.actaCalificaciones',compact('infoGrupo','alumnos_inscritos','membrete'));                          
        $pdfBoleta =  PDF::loadView('pdf.actaCalificaciones',compact('infoGrupo','alumnos_inscritos','membrete'));
        return $pdfBoleta->download($infoGrupo[0]->grupo.'-ActaCalificaciones-'.strftime("%b%Y").'.pdf');

    }

    public function actualizarHistoriales($alumnos,$nivelGrupo,$id_grupo){
        // dd($alumnos,$nivelGrupo,$id_grupo);
        foreach ($alumnos as $alumno) {
            $boleta = Boleta::where('num_control',$alumno->num_control)->where('id_grupo',$id_grupo)->get();

            if($boleta[0]->calif_f > 69){
                Historial::where('num_control',$alumno->num_control)->update([$nivelGrupo => 'aprobado']);
            }else{
                Historial::where('num_control',$alumno->num_control)->update([$nivelGrupo => 'reprobado']);
            }
        }

    }

    public function cambiosCalificaciones(){
        $cambios = Cambio::leftjoin('users','users.id','=','cambios.usuario')
                ->leftjoin('personas','personas.curp','=','users.curp_user')
                ->leftjoin('boletas','boletas.id_boleta','=','cambios.boleta')
                ->leftjoin('alumnos','alumnos.num_control','=','boletas.num_control')
                // ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                ->orderBy('cambios.updated_at','desc')
                ->orderBy('cambios.boleta')
                ->select('users.id','users.curp_user','users.tipo',
                         'personas.curp','personas.nombres','personas.ap_paterno','personas.ap_materno',
                         'boletas.*',
                         'cambios.*',
                         'alumnos.num_control')
                ->paginate(25);

        // $estudiantes = Cambio::leftjoin('boletas','boletas.id_boleta','=','cambios.boleta')
        //         ->leftjoin('alumnos','alumnos.num_control','=','boletas.num_control')
        //         ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
        //         ->orderBy('cambios.updated_at','desc')
        //         ->orderBy('cambios.boleta')
        //         ->select('personas.curp','personas.nombres','personas.ap_paterno','personas.ap_materno',
        //                 'boletas.id_boleta','boletas.num_control',
        //                 'cambios.id_cambio','cambios.boleta',
        //                 'alumnos.num_control')
        //         ->get();
        // dd($cambios,$estudiantes);
        return view('catalogos.cambiosCalif.cambios',compact('cambios'));
    }

    public function buscarCambios(Request $request){
        $search = $request->all();

        $cambios = Cambio::leftjoin('users','users.id','=','cambios.usuario')
                ->leftjoin('personas','personas.curp','=','users.curp_user')
                ->leftjoin('boletas','boletas.id_boleta','=','cambios.boleta')
                ->leftjoin('alumnos','alumnos.num_control','=','boletas.num_control')
                ->orderBy('cambios.updated_at','desc')
                ->orderBy('cambios.boleta')
                ->select('users.id','users.curp_user','users.tipo',
                        'personas.curp','personas.nombres','personas.ap_paterno','personas.ap_materno',
                        'boletas.*',
                        'cambios.*',
                        'alumnos.num_control')
                ->where('alumnos.num_control','like','%'.$search['buscar'].'%')
                ->orWhere('personas.ap_paterno','like','%'.$search['buscar'].'%')
                ->orWhere('personas.ap_materno','like','%'.$search['buscar'].'%')
                ->orWhere('personas.nombres','like','%'.$search['buscar'].'%')
                ->orWhere('users.tipo','like','%'.$search['buscar'].'%')
                ->orWhere('cambios.fecha','=',$search['buscar'])
                ->orWhere('cambios.hora','=',$search['buscar'])
                ->paginate(25)
                ->appends('buscar',$search['buscar']);

        return view('catalogos.cambiosCalif.cambios',compact('cambios'));
        
    }

}
