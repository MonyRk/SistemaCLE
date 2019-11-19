<?php

namespace App\Http\Controllers;

use App\ClasificacionPreguntas;
use Illuminate\Http\Request;

class ClasificacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $respuestas = ClasificacionPreguntas::get();
        // $respuestas = ClasificacionPreguntas::leftjoin('grupo_respuesta','grupo_respuesta.id_grupoRespuestas','=','respuestas.grupo_respuesta')->get();
        return view('catalogos.clasificacion.clasificaciones',compact('respuestas'));
    }

    public function store(Request $request)
    { 
        $data = request()->validate([
            'clasificacion' => 'required'
        ]);

        ClasificacionPreguntas::firstOrCreate([
            'clasificacion' => $data['clasificacion']
        ]);

        return redirect()->route('clasificacion')->with('success','¡La clasificación se ha guardado correctamente!');
    }


    public function update(Request $request)
    {   
        $data = request()->validate([
            'clasificacion' => 'required'
        ]);

        $respuesta = ClasificacionPreguntas::find($request->id_clasificacion)
                                ->update([
                                    'clasificacion' => $data['clasificacion']
                                ]);

        return redirect()->route('clasificacion')->with('success','¡La clasificacion se ha actualizado correctamente!');

    }

    public function destroy($id)
    {
        $data = request()->all();
        // dd($data);
        $r = Clasificacion::find($data['id_r_eliminar']);

        $r->delete();

        return redirect()->route('respuestas')->with('warning','La respuesta se eliminó.');
    }
}
