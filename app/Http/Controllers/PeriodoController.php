<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $periodos = DB::table('periodos')->select('*')->paginate(15);
        return view('catalogos.periodos.periodos', compact('periodos'));
    }

    
    public function store(Request $request)
    {
        $data = request()->validate([
            'periodo' => 'required',
            'anio' => 'required|digits:4'
            ]);

        Periodo::firstOrCreate([
            'descripcion' => $data['periodo'],
            'anio' => $data['anio']
        ]);

        return redirect()->route('periodos')->with('success','¡El periodo se agrego correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function actualizar()
    {
        $data = request('periodo_id');
    //   dd($data);
        Periodo::where('actual',true)->update([
            'actual' => NULL
        ]);
        Periodo::where('id_periodo',$data)->update([
            'actual' => true
        ]);
        
        $alumnos = Alumno::where('estatus','Inscrito')->get();
        foreach ($alumnos as $alumno) {
            Alumno::find($alumno->num_control)->update(['estatus' => 'No Inscrito']);
        }
        
        return back()->with('success','¡El periodo se ha actualizado correctamente!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Periodo $periodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periodo $periodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodo $periodo)
    {
        //
    }
}
