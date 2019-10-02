<?php

namespace App\Http\Controllers;

use App\GrupoRespuesta;
use Illuminate\Http\Request;

class GrupoRespuestaController extends Controller
{

    public function store(Request $request)
    {
        $data = request()->validate([
            'grupoR' => 'required|alpha_spaces'
        ]);

        GrupoRespuesta::firstOrCreate([
            'grupoRespuesta' => $data['grupoR']
        ]);

        return redirect()->route('respuestas')->with('success','¡El grupo de respuestas de creo correctamente!');
    }

    
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
