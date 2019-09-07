<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Boleta;
use App\Grupo;
use App\Inscripcion;
use App\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = DB::table('periodos')->orderBy('anio','DESC')->orderBy('descripcion','ASC')->get();
        $grupos = DB::table('grupos')->orderBy('grupo','ASC')->get();

        return view('boletas.boletas',compact('periodos','grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**_
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Boleta  $boleta
     * @return \Illuminate\Http\Response
     */
    public function show($grupo_periodo)
    {
        $data = request()->all();
        // dd($grupo_periodo);

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
                                        ->orderBy('personas.ap_paterno','ASC')  
                                        ->get();
// dd($alumnos_inscritos);

        return view('boletas.calificaciones',compact('infoGrupo','alumnos_inscritos'));

        // $alumno = Inscripcion::where('alumno_inscrito.num_control',$data['numero'])
        // ->leftjoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
        // ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
        // ->leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
        // ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        // ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        // ->leftjoin('docentes','grupos.docente','=','docentes.id_docente')
        // ->where('periodos.id_periodo',$data['periodo'])
        // ->get();

        // $docente = Inscripcion::where('alumno_inscrito.num_control',$data['numero'])
        // ->leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
        // ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
        // ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
        // ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        // ->where('periodos.id_periodo',$data['periodo'])
        // ->get();
        
        // $calificacion = Boleta::where('boletas.num_control',$data['numero'])
        // ->leftjoin('grupos','grupos.id_grupo','=','boletas.id_grupo')
        // ->leftjoin('periodos','periodos.id_periodo','=','grupos.periodo')
        // ->where('periodos.id_periodo',$data['periodo'])
        // ->get();
        //         // dd($calificacion);

        // if(empty($alumno[0])){
        //     return redirect()->route('boletas')->with('error','No se encontró ningún estudiante con ese número de control en el periodo especificado');
        // }else{

        // return view('boletas.calificaciones',compact('alumno','docente','calificacion'));
    // }

}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Boleta  $boleta
     * @return \Illuminate\Http\Response
     */
    public function edit(Boleta $boleta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Boleta  $boleta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $infoGrupo = DB::table('grupos')
        // ->leftjoin('nivels','nivels.id_nivel','=','grupos.nivel_id')
        // ->leftjoin('aulas','aulas.id_aula','=','grupos.aula')
        // ->where('id_grupo',3)
        // ->get();

        // $alumnos_inscritos = Inscripcion::where('alumno_inscrito.id_grupo',3)
        //                                 ->leftJoin('alumnos','alumnos.num_control','=','alumno_inscrito.num_control')
        //                                 ->leftjoin('boletas','alumnos.num_control','=','boletas.num_control')
        //                                 ->leftJoin('personas','alumnos.curp_alumno','=','personas.curp')  
        //                                 ->where('boletas.id_grupo',3) 
        //                                 ->whereNull('boletas.deleted_at')
        //                                 ->orderBy('personas.ap_paterno','ASC')  
        //                                 ->get();
       
        // dd(request()->all());
        // $data = json_decode($request->getContent());

        // dd($data);
        // $input = request()->all();
// dd($input);
        if($request->ajax()){ 
            return response()->json(['success',$request]);
        }
    }
    public function destroy(Boleta $boleta)
    {
        //
    }


    public function getGrupos(Request $request)
    { 
        if($request->ajax()){ 
            $grupos = Grupo::where('periodo',$request->id_periodo)
                            ->get();
            
            foreach ($grupos as $grupo) {
                $gruposArray[$grupo->id_grupo] = array ($grupo->grupo);
            }
            return response()->json($gruposArray);
        }
    }


    public function pruebaDatos(Request $request){
        return response()->json(['success'=>'HOLA MUNDO']);
    }
}
