<?php

namespace App\Http\Controllers;

use App\EvaluacionDocente;
use App\GrupoRespuesta;
use App\Periodo;
use App\Pregunta;
use App\Respuesta;
use Illuminate\Http\Request;

class EvaluacionDocenteController extends Controller
{

    public function index()
    {
        // $respuestas = Respuesta::get();
        $grupoRs = GrupoRespuesta::select('*')->distinct()->get();
        $tipoPregunta = Pregunta::select('tipo')->distinct()->get();
        $enfoque = Pregunta::where('tipo','Enfoque de Enseñanza')->get();
        $clima = Pregunta::where('tipo','Clima Afectivo')->get();
        $enseñanzas = Pregunta::where('tipo','Proceso de Enseñanza')->get();
        $retroalimentacion = Pregunta::where('tipo','Estrategias de Retroalimentacion')->get();

        return view('evaluacionDocente.evaluacion',compact('clima','enfoque','enseñanzas','tipoPregunta','retroalimentacion','grupoRs'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EvaluacionDocente  $evaluacionDocente
     * @return \Illuminate\Http\Response
     */
    public function show(EvaluacionDocente $evaluacionDocente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EvaluacionDocente  $evaluacionDocente
     * @return \Illuminate\Http\Response
     */
    public function edit(EvaluacionDocente $evaluacionDocente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EvaluacionDocente  $evaluacionDocente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EvaluacionDocente $evaluacionDocente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EvaluacionDocente  $evaluacionDocente
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluacionDocente $evaluacionDocente)
    {
        //
    }
}
