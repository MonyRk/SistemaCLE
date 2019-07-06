<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Alumno;
use App\Persona;
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
        $datos_alumnos = DB::table('alumnos')
                        ->join('personas','personas.curp','=','alumnos.curp_alumno')
                        ->select('personas.*','alumnos.*')
                        ->where('tipo', 'like' , '%alumno%')
                        // ->get()
                        ->paginate(10);// dd($datos_alumnos);
        return view('alumnos.alumnos',compact('datos_alumnos'));
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
        $datos_alumno = Alumno::join('personas','personas.curp','=','alumnos.curp_alumno')
        ->select('personas.*','alumnos.*')
        ->where('num_control',$id)
        ->get();
        return view('alumnos.showEstudiante',compact('datos_alumno'));

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
        

        return view('alumnos.editAlumno',compact('alumno','nombres_municipios','email'))->with('success','Datos del estudiante agregados correctamente!');// ['alumno' =>$datos_alumno]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Alumno $alumno)
    {                             
        $clave= $alumno->curp_alumno;//curp original
        
        $data = request()->validate([
            'name' => 'required|alpha_spaces',
            'curp' => array('required','alpha_num'),//,'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/','unique:personas,curp'),
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
        
       // dd($clave,$data['curp']);
       
       //$query1 = 'UPDATE personas SET curp="'.$data['curp'].'",nombres="'.$data['name'].'",ap_paterno="'.$data['apPaterno'].'",ap_materno="'.$data['apMaterno'].'",calle="'.$data['calle'].'",numero="'.$data['numero'].'",colonia="'.$data['colonia'].'",municipio="'.$data['municipio'].'",telefono="'.$data['telefono'].'",edad="'.$data['edad'].'",sexo="'.$data['sexo'].'" WHERE personas.curp = "?"';
       //dd($query1,$clave,$data['curp']);
       
       DB::update('UPDATE personas SET curp="'.$data['curp'].
       '",nombres="'.$data['name'].'",ap_paterno="'.$data['apPaterno'].
       '",ap_materno="'.$data['apMaterno'].'",calle="'.$data['calle'].
       '",numero="'.$data['numero'].'",colonia="'.$data['colonia'].
       '",municipio="'.$data['municipio'].'",telefono="'.$data['telefono'].
       '",edad="'.$data['edad'].'",sexo="'.$data['sexo'].'" WHERE personas.curp = "?"',[$clave]);

    //    $agregado = ('update personas set curp = "'.$data['curp'].
    //    '", nombres = "'.$data['name'].
    //    '", ap_paterno = "'.$data['apPaterno'].
    //    '", ap_materno = "'.$data['apMaterno'].
    //    '", calle = "'.$data['calle'].
    //    '", numero = "'.$data['numero'].
    //    '", colonia = "'.$data['colonia'].
    //    '", municipio = "'.$data['municipio'].
    //    '", telefono = "'.$data['telefono'].
    //    '", edad = "'.$data['edad'].
    //    '", sexo = "'.$data['sexo'].
    //    '" where personas.curp = "?"', [$id]);
  
  
  
        // $agregado = Persona::where('curp', '=', $data['curp'])
        //       ->update([
        //           'curp' => $data['curp'],
        //           'nombres' => $data['name'],
        //           'ap_paterno' => $data['apPaterno'],
        //           'ap_materno' => $data['apMaterno'],
        //           'calle' => $data['calle'],
        //           'numero' => $data['numero'],
        //           'colonia' => $data['colonia'],
        //           'municipio' => $data['municipio'],
        //           'telefono' => $data['telefono'],
        //           'edad' => $data['edad'],
        //           'sexo' => $data['sexo']
        //       ]);
  
        //   $agregado = Alumno::where('curp_alumno', '=', $data['curp'])
        //       ->update([
        //           'curp_alumno' => $data['curp'],
        //           'num_control' => $data['numControl'],
        //           'carrera' => $data['carrera'],
        //           'semestre' => $data['semestre'],
        //           //'estatus' => 'no inscrito',
        //       ]);
  
  //dd($agregado);
          return redirect()->route('verAlumnos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        $clave= $alumno->curp_alumno;
        $persona = Persona::where('curp','=', $clave);
        $alumno = Alumno::where('curp_alumno', '=', $clave);
        $alumno->delete();
        $persona->delete();
        return redirect()->route('verAlumnos');
    }


}
