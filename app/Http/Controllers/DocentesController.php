<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;
use App\Grupo;
use App\Persona;
use App\Municipio;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests\ValidarCrearDocenteRequest;
use App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class DocentesController extends Controller
{
    protected $usuarioactual;

    public function __construct()
    {
        $this->middleware('auth');
        $usuarioactual = \Auth::user();
    }

    public function index()
    {

        $docentes = DB::table('docentes')
                        ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
                        ->where('tipo', 'like' , '%docente%')
                        // ->whereIn('id_docente',$docentes_en_grupo)
                        ->whereNull('personas.deleted_at')
                        ->orderBy('docentes.id_docente','ASC')
                        ->paginate(25);
    
        return view('docentes.docentes',compact('docentes'));
    }

    public function search(Request $request)
    {
        $search = $request->all(); 
        
        $datos_docentes = DB::table('docentes')
                ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
                ->where('tipo', 'like' , '%docente%')
                ->whereNull('personas.deleted_at')
                ->where('personas.nombres','like','%'.$search['buscar'].'%')
                ->orWhere('personas.ap_paterno','like','%'.$search['buscar'].'%')
                ->orWhere('personas.ap_materno','like','%'.$search['buscar'].'%')
                ->orWhere('docentes.id_docente','like','%'.$search['buscar'].'%')
                ->orWhere('docentes.estatus','like',$search['buscar'].'%')
                ->orWhere('docentes.grado_estudios','like','%'.$search['buscar'].'%')
                ->orderBy('docentes.id_docente','ASC')
                ->paginate(25)
                ->appends('buscar',$search['buscar']);
                        
        return view ('docentes.docentes',compact('datos_docentes'));
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
            'cp' => $data['cp'],
            'telefono' => $data['telefono'],
            'edad' => $data['edad'],
            'sexo' => $data['sexo']
        ]);
        
        $tipo = Persona::find($data['curp']);
        $tipo->tipo = $data['tipo'];
        $tipo->save();
            
        Docente::firstOrCreate([
            'curp_docente' => $data['curp']
        ],[
            'rfc' => $data['rfc'],
            'grado_estudios' => $data['estudios'],
            'titulo' => $data['titulo'],
            'ced_prof' => $data['cedula'],
            'estatus' => $data['estatus']
        ]);

        User::firstOrCreate([
            'curp_user' => $data['curp']
        ],[
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['curp']),
            'tipo' => $data['tipo']
        ]);

        return redirect()->route('verDocentes')->with('success','Datos del docente correctamente guardados');
    }

    public function show($id)
    {
        $datos = Docente::leftjoin('personas','personas.curp','=','docentes.curp_docente')
        ->leftjoin('users','personas.curp','=','users.curp_user')
        ->select('personas.*','docentes.*','users.*')
        ->where('docentes.id_docente',$id)
        ->get();

        $municipio = Municipio::select('nombre_municipio')->where('id',$datos[0]->municipio)->pluck('nombre_municipio');//dd($nombres_municipios);//pluck('nombre_municipio');
        //dd($municipio);
        return view('docentes.showDocente',compact('datos','municipio'));

    }

    public function edit($id){
        $usuarioactual = \Auth::user();
       
        if ($usuarioactual->tipo != 'coordinador') {
            $ddocente = User::where('users.id',$usuarioactual->id)
                        ->leftjoin('docentes','users.curp_user','=','docentes.curp_docente')
                        ->get();
            if ($ddocente[0]->id_docente == $id) {
                $docente = Docente::leftjoin('personas','personas.curp','=','docentes.curp_docente')
                        ->select('personas.*','docentes.*')
                        ->where('docentes.id_docente', '=' , $id)
                        ->get();
            } else {
                return back()
                ->with('error','Lo sentimos, no tienes acceso a esta sección. Comunícate con la coordinación si necesitas el acceso.');//view('alumnos.editAlumno',compact('datos_alumno','nombres_municipios','niveles','email'));
            }
        }
        $docente = Docente::leftjoin('personas','personas.curp','=','docentes.curp_docente')
                        ->select('personas.*','docentes.*')
                        ->where('docentes.id_docente', '=' , $id)
                        ->get();
                       
        $nombres_municipios = Municipio::select('nombre_municipio')->pluck('nombre_municipio');

        $email = User::where('curp_user',$docente[0]->curp)->get();
        // dd($docente);
        return view('docentes.editDocente',compact('docente','nombres_municipios','email','usuarioactual'));
    }

    public function update(Docente $docente)
    {            
        $usuarioactual = \Auth::user();          
         $curp= $docente->curp_docente;//curp original
        
        //obtener los datos de la misma persona en todas las tablas relacionadas
        $persona = Persona::where('curp',$curp)->first();
        $infoDocente= Docente::find($docente->id_docente);
        $user = User::where('curp_user',$curp)->first();    
        // dd($infoDocente);
        //validacion de los datos
        if ($usuarioactual->tipo == 'docente') {
            $data = request()->validate([
                'name' => 'required|alpha_spaces',
                'curp' => array('required','alpha_num','regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'),
                'apPaterno' => 'required|alpha_spaces',
                // 'apMaterno' =>'alpha_spaces',
                'calle' => array('required','regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ,.]*$/'),
                'numero' => 'required|numeric',
                'colonia' => 'required|alpha_spaces',
                'municipio' => 'required',
                'cp' => 'required|numeric',
                'telefono' =>'required|numeric',
                'email' => array('required','email','regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/'),
                'edad' =>'required|digits:2',
                'sexo' => 'required'
            ]);
        }else{
            $data = request()->validate([
                'name' => 'required|alpha_spaces',
                'curp' => array('required','alpha_num','regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'),
                'apPaterno' => 'required|alpha_spaces',
                // 'apMaterno' =>'alpha_spaces',
                'calle' => array('required','regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ,.]*$/'),
                'numero' => 'required|numeric',
                'colonia' => 'required|alpha_spaces',
                'municipio' => 'required',
                'cp' => 'required|numeric',
                'telefono' =>'required|numeric',
                'email' => array('required','email','regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/'),
                'edad' =>'required|digits:2',
                'sexo' => 'required',
                'rfc' => 'required',
                'estudios' => 'required',
                'titulo' => 'required',
                'cedula' => 'required',
                'estatus' => 'required'
            ]);
            $infoDocente->rfc = $data['rfc'];
            $infoDocente->grado_estudios = $data['estudios'];
            $infoDocente->ced_prof = $data['cedula'];
            $infoDocente->titulo = $data['titulo'];
            $infoDocente->estatus = $data['estatus'];
            $infoDocente->save();
        }
        // dd(request()->apMaterno);
        // $persona->curp = $data['curp'];
        $persona->nombres = $data['name'];
        $persona->ap_paterno = $data['apPaterno'];
        $persona->ap_materno = request()->apMaterno;
        $persona->calle = $data['calle'];
        $persona->numero = $data['numero'];
        $persona->colonia = $data['colonia'];
        $persona->municipio = $data['municipio'];
        $persona->cp = $data['cp'];
        $persona->telefono = $data['telefono'];
        $persona->edad = $data['edad'];
        $persona->sexo = $data['sexo'];
        $persona->save();

        

        $user->name = $data['name'];
        // $user->curp_user = $data['curp'];
        $user->email = $data['email'];
        $user->save();

        $password = request()->all();
        if ($password['password']!= null) {
            $contrasenia = request()->validate([
                'password' => ['required', 'min:6', 'confirmed'],
                'password_confirmation' => ['required', 'min:6']
            ]);
            $user = User::where('curp_user',$curp)->first();
            $user->password = bcrypt($password['password']);
            $user->save();
        };
        
        $user = User::where('curp_user',$curp)->first();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        DB::update('update personas set curp = ? where curp = ?', [$data['curp'],$curp]);

        if($usuarioactual->tipo = 'docente'){
            return back()->with('success','¡Tus datos se actualizaron correctamente!');
        }else{
            return redirect()->route('verDocentes')->with('success','¡Los datos se actualizaron correctamente!');
        }
        
    }

    public function destroy(Request $request)
    {
        // dd(request()->all());
        $docente = Docente::where('id_docente',$request->docente_id)->get();

        $persona = Persona::where('curp',$docente[0]->curp_docente)->get();
// dd($docente,$persona);
        $user = User::where('curp_user',$docente[0]->curp_docente)->get();
        $user[0]->delete();
        $docente[0]->delete();
        $persona[0]->delete();
        // $clave= $docente->curp_docente;
        // $persona = Persona::where('curp','=', $clave);
        // $persona->delete();
        return redirect()->route('verDocentes')->with('warning','Los datos se eliminaron');
    }

    public function titulo($titulo){
        //se cambiara la ruta de los archivos
        $p = 'C:\Users\Mony\Downloads/'.$titulo;
        return response()->file($p);
    }

    public function rfc($rfc){
        //se cambiara la ruta de los archivos
        $p = 'C:\Users\Mony\Downloads/'.$rfc;
        return response()->file($p);
    }

    public function cedula($cedula){
        //se cambiara la ruta de los archivos
        $p = 'C:\Users\Mony\Downloads/'.$cedula;
        return response()->file($p);
    }
}
