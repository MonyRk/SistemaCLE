<?php

namespace App\Http\Controllers;

use App\Pregunta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    
    public function index()
    {
        
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = request()->validate([
            'pregunta' => 'required',
            'tipo' => 'required',
            'respuestas' => 'required',
            'vigencia' => 'required'
        ]);

        Pregunta::firstOrCreate([
            'pregunta' => $data['pregunta'],
            'tipo' => $data['tipo'],
            'id_respuesta' => $data['respuestas'],
            'vigencia' => $data['vigencia']
        ]);

        return redirect()->route('evaluacion')->with('success','¡La pregunta se agregó correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show(Pregunta $pregunta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregunta $pregunta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->idpreg);
        $data = request()->validate([
            'pregunta' => 'required',
            'respuestas' => 'required',
            'tipo' => 'required',
            'vigencia' => 'required'
        ]);

        $respuesta = Pregunta::find($request->idpreg)
                                ->update([
                                    'pregunta' => $data['pregunta'],
                                    'tipo' => $data['tipo'],
                                    'id_respuesta' => $data['respuestas'],
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
