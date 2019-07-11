<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Alumno;
use App\Persona;
use App\Nivel;
use App\Municipio;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidarCrearAlumnoRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Pagination\Paginator;

class AlumnosController extends Controller
{
    

    public function index()
    {
        $niveles = Nivel::whereNull('deleted_at')->get();
        // dd($niveles);
        $datos_alumnos = DB::table('alumnos')
                        ->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')
                        ->where('tipo', 'like' , '%alumno%')
                        ->whereNull('personas.deleted_at')
                        ->orderBy('alumnos.num_control','ASC')
                        ->paginate(10);
                        
                
        return view('alumnos.alumnos',compact('datos_alumnos','niveles'));
    }

    public function create()
    {
        $nombres_municipios = Municipio::select('*')->get();
       
        return view('alumnos.createAlumno',compact('nombres_municipios'));
    }

    /**
     * Valida si los datos ingresados estan correctamente escritos y 
     * crea en la base de datos el registro en cada tabla
     */
    public function store(ValidarCrearAlumnoRequest $request)
    {
        $data = request()->all();
        
                $agregar = Persona::firstOrCreate([
                    'curp' => $data['curp']
                ],[
                    'nombres' => $data['name'],
                    'ap_paterno' => $data['apPaterno'],
                    'ap_materno' => $data['apMaterno'],
                    'calle' => $data['calle'],
                    'numero' => $data['numero'],
                    'colonia' => $data['colonia'],
                    'municipio' => $data['municipio'],
                    'telefono' => $data['telefono'],
                    'edad' => $data['edad'],
                    'sexo' => $data['sexo'],
                    'tipo' => 'alumno'
                ]);
        
        
                Alumno::firstOrCreate([
                    'curp_alumno' => $data['curp']
                ],[
                    'num_control' => $data['numControl'],
                    'carrera' => $data['carrera'],
                    'semestre' => $data['semestre'],
                    'estatus' => 'no inscrito',
                ]);

                User::firstOrCreate([
                    'curp_user' => $data['curp']
                ],[
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['curp'])
                ]);
            
        // }       
        

        return redirect()->route('verAlumnos')->with('success','Datos del estudiante agregados correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datos = Alumno::join('personas','personas.curp','=','alumnos.curp_alumno')
        ->select('personas.*','alumnos.*')
        ->where('num_control',$id)
        ->get();

        $municipio = Municipio::select('nombre_municipio')->where('id',$datos[0]->municipio)->get();//dd($nombres_municipios);//pluck('nombre_municipio');
        return view('alumnos.showEstudiante',compact('datos','municipio'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno){

        $alumno = Alumno::join('personas','personas.curp','=','alumnos.curp_alumno')
                        ->select('personas.*','alumnos.*')
                        ->where('num_control', '=' , $alumno->num_control)
                        ->get();
                        //dd($datos_alumno);
        $nombres_municipios = Municipio::select('nombre_municipio')->pluck('nombre_municipio');
//dd($alumno);
        $email = User::where('curp_user',$alumno[0]->curp)->get();
        
// dd($email);
        return view('alumnos.editAlumno',compact('alumno','nombres_municipios','email'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Alumno $alumno)
    {                             
        $curp= $alumno->curp_alumno;//curp original
        $numControl = $alumno->num_control; //num de control original
  
        //obtener los datos de la misma persona en todas las tablas relacionadas
        $persona = Persona::find($curp); 
        $infoAlumno= Alumno::find($numControl);
        $user = User::where('curp_user',$curp)->first();    
        
        //validacion de los datos
        $data = request()->validate([
            'name' => 'required|alpha_spaces',
            'curp' => array('required','alpha_num','regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/','unique:personas,curp'),
            'apPaterno' => 'required|alpha_spaces',
            'apMaterno' =>'required|alpha_spaces',
            'calle' => array('required','regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ,.]*$/'),
            'numero' => 'required|numeric',
            'colonia' => 'required|alpha_spaces',
            'municipio' => 'required',
            'telefono' =>'required|numeric',
            'email' => array('required','email','regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/','unique:users,email'),
            'edad' =>'required|digits:2',
            'sexo' => 'required',
            'numControl' => 'required|digits:8',
            'carrera' => 'required',
            'semestre' => 'required'
        ]);
        
        $persona->curp = $data['curp'];
        $persona->nombres = $data['name'];
        $persona->ap_paterno = $data['apPaterno'];
        $persona->ap_materno = $data['apMaterno'];
        $persona->calle = $data['calle'];
        $persona->numero = $data['numero'];
        $persona->colonia = $data['colonia'];
        $persona->municipio = $data['municipio'];
        $persona->telefono = $data['telefono'];
        $persona->edad = $data['edad'];
        $persona->sexo = $data['sexo'];
        $persona->save();

        $infoAlumno->num_control = $data['numControl'];
        $infoAlumno->curp_alumno = $data['curp'];
        $infoAlumno->carrera = $data['carrera'];
        $infoAlumno->semestre = $data['semestre'];
        $infoAlumno->save();

        $user->name = $data['name'];
        $user->curp_user = $data['curp'];
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->save();


        return redirect()->route('verAlumnos')->with('success','!Los datos de actualizaron correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)//(Alumno $alumno)
    {
        $alumno = Alumno::findOrFail($request->alumno_id);
       
        $persona = Persona::findOrFail($alumno->curp_alumno);
        
        $user = User::where('curp_user',$alumno->curp_alumno)->get();//->softDeletes();
        //dd($user[0]);
        $user[0]->delete();
        $alumno->delete();

        //dd($alumno);
        // $clave= $alumno->curp_alumno;
        // $persona = Persona::where('curp','=', $clave);
        // $alumno = Alumno::where('curp_alumno', '=', $clave);
        // $user = User::where('curp_user',$clave);
         
        $persona->delete();
        
        return redirect()->route('verAlumnos')->with('warning','Los datos se eliminaron');
    }


}
