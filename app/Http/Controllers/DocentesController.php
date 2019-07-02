<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;
use App\Persona;
use App\Municipio;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidarCrearDocenteRequest;

class DocentesController extends Controller
{
    public function index()
    {
        $datos_docentes = Docente::join('personas','personas.curp','=','docentes.curp_docente')
                        ->select('personas.*','docentes.*')
                        ->where('tipo', 'like' , '%docente%')
                        ->get();
        return view('docentes.docentes',compact('datos_docentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $nombres_municipios = Municipio::select('*')->get();
       
        return view('docentes.createDocente',compact('nombres_municipios'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarCrearDocenteRequest $request)
    {
        $data = request()->all();
        $tipo = 'docente';
        $agregar = Persona::create([
            'curp' => $data['curp'],
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
            'tipo' => $tipo
        ]);
        
        Docente::create([
            'curp_docente' => $data['curp'],
            'rfc' => $data['rfc'],
            'grado_estudios' => $data['estudios'],
            'titulo' => $data['titulo'],
            'ced_prof' => $data['cedula']
        ]);
        return redirect()->route('verDocentes')->with('success','Datos del docente correctamente guardados');
    }


    public function destroy(Docente $docente)
    {
        $clave= $docente->curp_docente;
        $persona = Persona::where('curp','=', $clave);
        $persona->delete();
        return redirect()->route('verDocentes');
    }
}
