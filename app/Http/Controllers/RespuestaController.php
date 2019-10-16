<?php

namespace App\Http\Controllers;

use App\GrupoRespuesta;
use App\Respuesta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $grupoRespuesta = GrupoRespuesta::get();
        $respuestas = Respuesta::leftjoin('grupo_respuesta','grupo_respuesta.id_grupoRespuestas','=','respuestas.grupo_respuesta')->get();
        return view('catalogos.respuestas.respuestas',compact('respuestas','grupoRespuesta'));
    }

    public function store(Request $request)
    { 
        $data = request()->validate([
            'respuesta' => 'required',
            'tipo' => 'required'
        ]);

        Respuesta::firstOrCreate([
            'respuesta' => $data['respuesta'],
            'grupo_respuesta' => $data['tipo']
        ]);

        return redirect()->route('respuestas')->with('success','¡La respuesta se ha guardado correctamente!');
    }


    public function update(Request $request)
    {   
        $data = request()->validate([
            'respuesta' => 'required',
            'tipo' => 'required'
        ]);

        $respuesta = Respuesta::find($request->id_respuesta)
                                ->update([
                                    'respuesta' => $data['respuesta'],
                                    'grupo_respuesta' => $data['tipo']
                                ]);

        return redirect()->route('respuestas')->with('success','¡La respuesta se ha actualizado correctamente!');

    }

    public function destroy($id)
    {
        $data = request()->all();
        // dd($data);
        $r = Respuesta::find($data['id_r_eliminar']);

        $r->delete();

        return redirect()->route('respuestas')->with('warning','La respuesta se eliminó.');
    }
}
