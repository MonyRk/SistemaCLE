<?php

namespace App\Http\Controllers;

use App\Pregunta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        
        $data = request()->validate([
            'pregunta' => 'required',
            'tipo' => 'required',
            'vigencia' => 'required'
        ]);

        Pregunta::firstOrCreate([
            'pregunta' => $data['pregunta'],
            'id_clasificacion' => $data['tipo'],
            'vigencia' => $data['vigencia']
        ]);

        return redirect()->route('evaluacion')->with('success','¡La pregunta se agregó correctamente!');
    }

    public function update(Request $request)
    {
        // dd($request->idpreg);
        $data = request()->validate([
            'pregunta' => 'required',
            'tipo' => 'required',
            'vigencia' => 'required'
        ]);

        $respuesta = Pregunta::find($request->idpreg)
                                ->update([
                                    'pregunta' => $data['pregunta'],
                                    'id_clasificacion' => $data['tipo'],
                                    'vigencia' => $data['vigencia']
                                ]);

        return redirect()->route('evaluacion')->with('success','¡La pregunta se ha actualizado correctamente!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = request()->all();
        $pregunta = Pregunta::find($data['idpregunta']);
        $pregunta->delete();

        return redirect()->route('evaluacion')->with('error','La pregunta se elimino');
    }
}
