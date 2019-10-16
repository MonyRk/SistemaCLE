<?php

namespace App\Http\Controllers;

use App\Nivel;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarCrearNivelRequest;
use App\HorasDisponible;

class NivelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $niveles = Nivel::select('*')->get();

        return view('catalogos.niveles.niveles',compact('niveles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('catalogos.niveles.createNivel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarCrearNivelRequest $request)
    {
        $data = request()->all();
        
            Nivel::create([
                'nivel' => $data['nivel'],
                'modulo' => $data['modulo'],
                'idioma' => $data['idioma'],
            ]);
        
        return redirect()->route('verNiveles')->with('success','¡El nivel se agregó correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function show(Nivel $nivel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function edit(Nivel $nivel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nivel $nivel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 
        $nivelE = Nivel::where('id_nivel','=', $request->nivel_id)->get(); 
        $nivelE[0]->delete();
        return redirect()->route('verNiveles')->with('warning','Los datos del nivel se eliminaron.');
    }
}
