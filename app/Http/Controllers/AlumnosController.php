<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Alumno;
use App\Boleta;
use App\EvaluacionDocente;
use App\Historial;
use App\Persona;
use App\Nivel;
use App\Municipio;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidarCrearAlumnoRequest;
use App\Inscripcion;
use App\Periodo;
use App\ResultadoPregunta;
use CreateAlumnosInscritosTable;

class AlumnosController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
        
    // }

    public function index()
    {       
        $this->middleware('auth');
        $usuarioactual = \Auth::user();
        $datos_alumnos = DB::table('alumnos')
                    ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                    ->where('personas.tipo', 'like' , '%alumno%')
                    ->whereNull('personas.deleted_at')
                    ->orderBy('alumnos.num_control','ASC')
                    ->paginate(25);
        // $alumnos_sin_actividad = Alumno::where
    
        return view('alumnos.alumnos',compact('datos_alumnos','usuarioactual'));
    }

    public function search(Request $request)
    {
        $search = $request->all();
        
        $datos_alumnos = DB::table('alumnos')
                ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                ->where('tipo', 'like' , '%alumno%')
                ->whereNull('personas.deleted_at')
                ->where('personas.nombres','like','%'.$search['buscar'].'%')
                ->orWhere('personas.ap_paterno','like','%'.$search['buscar'].'%')
                ->orWhere('personas.ap_materno','like','%'.$search['buscar'].'%')
                ->orWhere('alumnos.num_control','like','%'.$search['buscar'].'%')
                ->orWhere('alumnos.estatus','like',$search['buscar'].'%')
                ->orWhere('alumnos.carrera','like','%'.$search['buscar'].'%')
                ->orderBy('alumnos.num_control','ASC')
                ->paginate(25)
                ->appends('buscar',$search['buscar']);
                        
        return view ('alumnos.alumnos',compact('datos_alumnos'));
    }

    public function create()
    {
        // $usuarioactual=\Auth::user(); 
        // dd($usuarioactual);
        $nombres_municipios = Municipio::select('*')->get();
    
        $niveles = Nivel::select('*')->get();
       
        return view('alumnos.createAlumno',compact('nombres_municipios','niveles'));
    }

    

    /**
     * Valida si los datos ingresados estan correctamente escritos y 
     * crea en la base de datos el registro en cada tabla
     */
    public function store(ValidarCrearAlumnoRequest $request)
    {
        $data = request()->all();
            
        // se crea la persona 
        $agregar = Persona::firstOrCreate([
            'curp' => $data['curp']
        ],[
            'nombres' => $data['name'],
            'ap_paterno' => $data['apPaterno'],
            'calle' => $data['calle'],
            'numero' => $data['numero'],
            'colonia' => $data['colonia'],
            'municipio' => $data['municipio'],
            'cp' => $data['cp'],
            'telefono' => $data['telefono'],
            'edad' => $data['edad'],
            'sexo' => $data['sexo'],
            'tipo' => 'alumno'
        ]);

        DB::update('update personas set ap_materno = ? where curp = ?', [$data['apMaterno'],$data['curp']]);
        
        //se crea el estudiante
        Alumno::firstOrCreate([
            'curp_alumno' => $data['curp']
        ],[
            'num_control' => $data['numControl'],
            'carrera' => $data['carrera'],
            'semestre' => $data['semestre'],
            'estatus' => 'no inscrito',
        ]);

        //se crea el usuario para accesar
        $usuario = User::firstOrCreate([
            'curp_user' => $data['curp']
        ],[
            'name' => $data['name'],
            'password' => bcrypt($data['curp']),
            'tipo' => 'alumno'
        ]);

        if ($data['email'] != null) {
            $usuario->update([
                'email' => $data['email']
            ]);
        };
        //se verifica si hay apellido materno para agregar el nombre completo a la tabla historial
        // if ($data['apMaterno'] != null) {
        //     $nombre = $data['name'].' '.$data['apPaterno'].' '.$data['apMaterno'];
        // }else{
        //     $nombre = $data['name'].' '.$data['apPaterno'];
        // };

        //se agrega el estudiante a la tabla historial
        Historial::firstOrCreate([
            'num_control' => $data['numControl'],
        ],[
            'nombres' => $data['name'],
            'ap_paterno' => $data['apPaterno'],
            'ap_materno' => $data['apMaterno'],
            'carrera' => $data['carrera'],
            'semestre' => $data['semestre']
        ]);

        //verifica si el estudiante realizo examen
        if (request()->has('examen')) {
            $periodo_actual = Periodo::where('actual',true)->get();
            $a = Alumno::find($data['numControl']);
            $a->nivel_inicial = $data['nivel'];
            $a->periodo_examen = $periodo_actual[0]->id_periodo;
            $a->save();


            // if ($data['nivel'] == 'A1M1') {
            //     Historial::where('num_control',$data['numControl'])->update([
            //         $data['nivel'] => 'cursando'
            //     ]);
            // };
            if ($data['nivel'] == 'A2M1') {
                Historial::where('num_control',$data['numControl'])->update([
                    'A1M1' => 'aprobado',
                    // 'A2M1' => 'cursando'
                ]);
            };
            if ($data['nivel'] == 'A2M2') {
                Historial::where('num_control',$data['numControl'])->update([
                    'A1M1' => 'aprobado',
                    'A2M1' => 'aprobado',
                    // 'A2M2' => 'cursando'
                ]);
            };
            if ($data['nivel'] == 'B1M1') {
                Historial::where('num_control',$data['numControl'])->update([
                    'A1M1' => 'aprobado',
                    'A2M1' => 'aprobado',
                    'A2M2' => 'aprobado',
                    // 'B1M1' => 'cursando'
                ]);
            };
            if ($data['nivel'] == 'B1M2') {
                Historial::where('num_control',$data['numControl'])->update([
                    'A1M1' => 'aprobado',
                    'A2M1' => 'aprobado',
                    'A2M2' => 'aprobado',
                    'B1M1' => 'aprobado',
                    // 'B1M2' => 'cursando'
                ]);
            };
        };
             
        $usuarioactual=\Auth::user();

       if($usuarioactual != null ){
        return redirect()->route('verEstudiantes')->with('success','Datos del estudiante agregados correctamente!');
       }else{
        return redirect()->route('login')->with('success','¡Tus datos se han agregado correctamente! Ahora puedes iniciar sesión con el correo registrado y tu CURP como contraseña');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datos = Alumno::leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
        ->select('personas.*','alumnos.*')
        ->where('num_control',$id)
        ->get();
// dd($id);
        $municipio = Municipio::select('nombre_municipio')->where('id',$datos[0]->municipio)->pluck('nombre_municipio');//dd($nombres_municipios);//pluck('nombre_municipio');
        // dd($id);
        return view('alumnos.showEstudiante',compact('datos','municipio'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    { 
        
        $usuarioactual= \Auth::user();
        // dd($usuarioactual);
        if ($usuarioactual->tipo != 'coordinador') {
            $sesion_actual = User::where('users.id',$usuarioactual->id)
                            ->leftjoin('alumnos','users.curp_user','=','alumnos.curp_alumno')
                            ->get();
                            // dd($sesion_actual[0]->num_control);
            if ($sesion_actual[0]->num_control == $alumno->num_control) {
                $datos_alumno = Alumno::where('alumnos.num_control',$sesion_actual[0]->num_control)
                            ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                            ->get();
                            // dd($sesion_actual[0]);
                $email = $sesion_actual[0]->email;
            } else {
                return back()
                ->with('error','Lo sentimos, no tienes acceso a esta sección. Comunícate con la coordinación si necesitas el acceso.');//view('alumnos.editAlumno',compact('datos_alumno','nombres_municipios','niveles','email'));
            }
        }else{
            $datos_alumno = Alumno::where('alumnos.num_control',$alumno->num_control)
            ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
            ->get(); 
            $encontrar_email = User::select('email')->where('curp_user',$datos_alumno[0]->curp)->get();
            $email = $encontrar_email[0]->email;
        }        
        
        // dd($email);
                                  
        $nombres_municipios = Municipio::select('nombre_municipio')->pluck('nombre_municipio');
        
        $niveles = Nivel::select('*')->get();

        
       
        
        return view('alumnos.editAlumno',compact('datos_alumno','nombres_municipios','niveles','email','usuarioactual'));//,'email'));
    }

    public function update(Alumno $alumno)
    {                 
        // dd($alumno);
        $usuarioactual= \Auth::user();
        $periodo_actual = Periodo::where('actual',true)->get();
        $curp = $alumno->curp_alumno;//curp original
        $numControl = $alumno->num_control; //num de control original  
        $data = request()->validate([
            'name' => 'required|alpha_spaces',
            'curp' => array('required','alpha_num','regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'),
            'apPaterno' => 'required|alpha_spaces',
            // 'apMaterno' =>'alpha_spaces',
            'calle' => array('required','regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ,.]*$/'),
            'numero' => 'required|numeric',
            'colonia' => 'required|alpha_spaces',
            'municipio' => 'required',
            'cp' => 'required|numeric',
            'telefono' =>'required|numeric',
            'email' => array('required','email','regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/'),
            'edad' =>'required|digits:2',
            'sexo' => 'required',
            'numControl' => array('required','regex:/^[A-Z]{1}\d{8}|\d{8}$/'),
            'carrera' => 'required',
            'semestre' => 'required',
        ]); 
        if(request()->has('examen')){
            $examen = request()->validate([
                'nivel' => 'required'
            ]);
        }

        //obtener los datos de la misma persona en todas las tablas relacionadas
        $apm = request()->all();

        // dd($apm);
            Persona::find($curp)->update([
            'ap_materno' => $apm['apMaterno']
            ]);
            // dd($data,$apm);
        $persona = Persona::find($curp)->update([
            // 'curp' => $data['curp'],
            'nombres' => $data['name'],
            'ap_paterno' => $data['apPaterno'],
            'calle' => $data['calle'],
            'numero' => $data['numero'],
            'colonia' => $data['colonia'],
            'municipio' => $data['municipio'],
            'cp' => $data['cp'],
            'telefono' => $data['telefono'],
            'edad' => $data['edad'],
            'sexo' => $data['sexo']
        ]); 
        
        //actualizar la informacion en la tabla de alumno
        $infoAlumno= Alumno::find($numControl);

        if(request()->has('examen')){
            $infoAlumno->nivel_inicial = $apm['nivel'];
            $infoAlumno->periodo_examen = $periodo_actual[0]->id_periodo;
        }else{
            $infoAlumno->nivel_inicial = NULL;
            $infoAlumno->periodo_examen = NULL;
        }

        $infoAlumno->num_control = $data['numControl'];
        $infoAlumno->carrera = $data['carrera'];
        $infoAlumno->semestre = $data['semestre'];
        $infoAlumno->save();
        
        //actualizar la informacion del usuario verificando si se modifico la contraseña o no 
        // $c = request()->all();
        if ($apm['password']!= null) {
            $contrasenia = request()->validate([
                'password' => ['required', 'min:6', 'confirmed'],
                'password_confirmation' => ['required', 'min:6']
            ]);
            $user = User::where('curp_user',$curp)->first();
            $user->password = bcrypt($apm['password']);
            $user->save();
        };
        
        $user = User::where('curp_user',$curp)->first();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        
        
        DB::update('update personas set curp = ? where curp = ?', [$data['curp'],$curp]);
        
        //tabla historial
        // if ($apm['apMaterno'] != null){
        //     $nombre = $data['name'].' '.$data['apPaterno'].' '.$apm['apMaterno'];
        // }else {
        //     $nombre = $data['name'].' '.$data['apPaterno'];
        // }

        $historial = Historial::where('num_control',$numControl)->get();
        
        if($historial->isNotEmpty())
        {

            $historial[0]->num_control = $data['numControl'];
            $historial[0]->nombres = $data['name'];
            $historial[0]->ap_paterno = $data['apPaterno'];
            $historial[0]->ap_materno = $apm['apMaterno'];
            $historial[0]->carrera = $data['carrera'];
            $historial[0]->semestre = $data['semestre'];
            $historial[0]->save();
        }



        // if ($apm['foliopago']!= null) {
        //     $pago = request()->validate([
        //         'foliopago' => 'numeric',
        //         'monto' => 'required|numeric'
        //     ]);

        //     $i= Inscripcion::where('num_control',$data['numControl'])
        //                 ->whereNull('folio_pago')
        //                 ->orderBy('updated_at','DESC')
        //                 ->get();

        //     if($i->isEmpty()){
        //         Inscripcion::create([
        //             'num_control' => $data['numControl'],
        //             'folio_pago' => $apm['foliopago'],
        //             'monto_pago' => $apm['monto'],
        //             'fecha' => date("d/m/Y")
        //         ]);
        //     }else{
        //         $i[0]->num_control = $data['numControl'];
        //         $i[0]->folio_pago = $apm['foliopago'];
        //         $i[0]->monto_pago = $apm['monto'];
        //         $i[0]->fecha = date("d/m/Y");
        //         $i[0]->save();
        //     }          

        // };

        if ($usuarioactual->tipo!= 'coordinador') {
            return back()->with('success','¡Los datos se actualizaron correctamente!');
        } else {
            return redirect()->route('verEstudiantes')->with('success','¡Los datos se actualizaron correctamente!');
        }
        
        
    }


    public function destroy(Request $request)//(Alumno $alumno)
    {
        // dd();
        $alumno = Alumno::where('num_control',$request->alumno_id)->get();
        
        $persona = Persona::where('curp',$alumno[0]->curp_alumno)->get();
        
        $user = User::where('curp_user',$alumno[0]->curp_alumno)->get();

        $historial = Historial::where('num_control',$request->alumno_id)->get();

        $inscripciones = Inscripcion::where('num_control',$request->alumno_id)->get();

        $boletas = Boleta::where('num_control',$request->alumno_id)->get();
        // dd($alumno,$persona,$user);
        if($historial->isNotEmpty()){
            $historial[0]->delete();
        }
        if($user->isNotEmpty()){
            $user[0]->delete();
        }
        if($alumno->isNotEmpty()){
            $alumno[0]->delete();
        }
        if($persona->isNotEmpty()){
            $persona[0]->delete();
        }
        if($inscripciones->isNotEmpty()){
            foreach ($inscripciones as $inscripcion) {
                $inscripcion->delete();
            }
        }
        if($boletas->isNotEmpty()){
            foreach ($boletas as $boleta) {
                $boleta->delete();
            }
        }
        
        return redirect()->route('verEstudiantes')->with('warning','Los datos se eliminaron');
    }

    public function recuperarEstudiantes(){
        
        // $this->middleware('auth');
        $usuarioactual = \Auth::user();
        $datos_alumnos = DB::table('alumnos')
                    ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                    ->where('tipo', 'like' , '%alumno%')
                    ->whereNotNull('alumnos.deleted_at')
                    ->orderBy('alumnos.num_control','ASC')
                    // ->onlyTrashed()
                    ->paginate(25);
    // dd($datos_alumnos);
        return view('alumnos.eliminados',compact('datos_alumnos','usuarioactual'));
    }

    public function recuperar($dato){
        $data = request()->all();

        $persona = Persona::withTrashed()->where('curp',$data['alumno_id'])->restore();
        $alumno = Alumno::withTrashed()->where('curp_alumno',$data['alumno_id'])->restore();
        $usuario = User::withTrashed()->where('curp_user',$data['alumno_id'])->restore();
        $num_control = Alumno::where('curp_alumno',$data['alumno_id'])->first();
        $historial = Historial::withTrashed()->where('num_control',$num_control->num_control)->restore();
        $boletas = Boleta::withTrashed()->where('num_control',$num_control->num_control)->get();
        foreach ($boletas as $boleta ) {
            Boleta::withTrashed()->where('num_control',$boleta->num_control)->restore();
        }
        $inscripciones = Inscripcion::withTrashed()->where('num_control',$num_control->num_control)->get();
        foreach ($inscripciones as $inscripcion ) {
            Inscripcion::withTrashed()->where('num_control',$inscripcion->num_control)->restore();
        }
        $evaluaciones = EvaluacionDocente::withTrashed()->where('num_control',$num_control->num_control)->get();
        foreach ($evaluaciones as $evaluacion) {
            ResultadoPregunta::withTrashed()->where('num_evaluacion',$evaluacion->num_evaluacion)->restore();
        }
        return back()->with('success','Los datos del estudiante se recuperaron');
    }

    

}
