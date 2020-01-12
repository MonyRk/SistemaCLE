<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Request;
use App\Docente;
use App\Grupo;
use App\Persona;
use App\Municipio;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests\ValidarCrearDocenteRequest;
use App\Http\Controllers\Auth;
use Barryvdh\DomPDF\Facade as PDF;

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
        
        $docentes = DB::table('docentes')
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
                        
        return view ('docentes.docentes',compact('docentes'));
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
    //    dd($data);
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
            
        $docente = Docente::firstOrCreate([
            'curp_docente' => $data['curp']
        ],[
            'rfc' => $data['rfc']->getClientOriginalName(),
            'grado_estudios' => $data['estudios'],
            'titulo' => $data['titulo']->getClientOriginalName(),
            'ced_prof' => $data['cedula']->getClientOriginalName(),
            // 'certificaciones' => $certificaciones,
            'estatus' => $data['estatus']
        ]);
        $fileRFC = $docente->id_docente.$data['rfc']->getClientOriginalName();
        $data['rfc']->storeAs('documentosCLE',$fileRFC);

        $fileCedula = $docente->id_docente.$data['cedula']->getClientOriginalName();
        $data['cedula']->storeAs('documentosCLE',$fileCedula);

        $fileTitulo = $docente->id_docente.$data['titulo']->getClientOriginalName();
        $data['titulo']->storeAs('documentosCLE',$fileTitulo);

        if ($request->hasFile('certificaciones')) {
            $certificaciones ="";
                foreach ($data['certificaciones'] as $cert ) {
                    $certificaciones = $certificaciones.','.$cert->getClientOriginalName();
                    $fileName = $docente->id_docente.$cert->getClientOriginalName();
                    $cert->storeAs('documentosCLE',$fileName);
                    
                }
                $certificaciones = substr($certificaciones,1);
                $docente->certificaciones = $certificaciones;
                $docente->save();

                // $documentos = split(',',$certificaciones);
                // foreach ($documentos as $docs) {
                //     $fileName = time().$docs;
                    
                // }   
            
        }

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
        if ($email->isNotEmpty()) {
            $email = $email[0]->email;
        }else{
            $email = " ";
        }
        
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
        // dd($persona,$infoDocente,$user);
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
                'telefono' =>'sometimes|nullable|numeric',
                'certificaciones' => 'sometimes|nullable',
                'estudios' => 'sometimes|nullable',
                'email' => array('sometimes','nullable','email','regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/'),
                'edad' =>'required|digits:2',
                'sexo' => 'required',
                'dominio' => 'sometimes|nullable',
                'curso' => 'sometimes|nullable',
                'didactica' => 'sometimes|nullable',
                'experiencia' => 'sometimes|nullable',
                'actualizacion' => 'sometimes|nullable'
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
                'telefono' =>'sometimes|nullable|numeric',
                'email' => array('sometimes','nullable','email','regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/'),
                'edad' =>'required|digits:2',
                'sexo' => 'required',
                'rfc' => 'sometimes|nullable',
                'certificaciones' => 'sometimes|nullable',
                'estudios' => 'sometimes|nullable',
                'titulo' => 'sometimes|nullable',
                'cedula' => 'sometimes|nullable',
                'estatus' => 'required',
                'dominio' => 'sometimes|nullable',
                'curso' => 'sometimes|nullable',
                'didactica' => 'sometimes|nullable',
                'experiencia' => 'sometimes|nullable|numeric',
                'actualizacion' => 'sometimes|nullable'
            ]);

            $c = request()->all();
            // dd($data,$c);
            if(request()->has('certificaciones') && $c['certificaciones'][0]!=null){
                $certificaciones ="";
                foreach ($c['certificaciones'] as $cert ) {
                    $certificaciones = $certificaciones.','.$cert->getClientOriginalName();
                    $fileCertificaciones = $cert;    
                    $fileName = $docente->id_docente.$fileCertificaciones->getClientOriginalName();
                    
                    $fileCertificaciones->move(storage_path('app').'/documentosCLE',$fileName);
                    // $fileCertificaciones->move(public_path().'/documentosCLE/',$fileName);
                }
                $certificaciones = substr($certificaciones,1);
                $infoDocente->certificaciones = $certificaciones;
            }
        }
            
        if (request()->has('dominio')) {
            $infoDocente->dominio_idioma = $data['dominio'];
        }
        if (request()->has('curso')) {
            $infoDocente->curso = $data['curso'];
        }
        if (request()->has('didactica') && $data['didactica'][0] != null) {
            $datos_didacticas = "";
            foreach ($data['didactica'] as $didactica ) {
                $datos_didacticas = $datos_didacticas.';'.$didactica;
            }
            $datos_didacticas = substr($datos_didacticas, 1);
            // return $datos_didacticas;
            $infoDocente->didactica = $datos_didacticas;
        }
        if (request()->has('experiencia')) {
            $infoDocente->experiencia = $data['experiencia'];
        }
        if (request()->has('actualizacion') && $data['actualizacion'][0] != null) {
            $actualizaciones = "";
            foreach ($data['actualizacion'] as $actualizacion ) {
                $actualizaciones = $actualizaciones.';'.$actualizacion;
            }
            $actualizaciones = substr($actualizaciones, 1);
            // return $actualizaciones;
            $infoDocente->actualizacion = $actualizaciones;
        }
        // return 'fin';
            if (request()->has('cedula')) {
                $infoDocente->ced_prof = $data['cedula']->getClientOriginalName();
                $fileCedula = $data['cedula'];    
                $fileName = $docente->id_docente.$fileCedula->getClientOriginalName();
                $fileCedula->move(storage_path('app').'/documentosCLE',$fileName);
            }
            if (request()->has('titulo')) {
                $infoDocente->titulo = $data['titulo']->getClientOriginalName();
                $fileTitulo = $data['titulo'];    
                $fileName = $docente->id_docente.$fileTitulo->getClientOriginalName();
                $fileTitulo->move(storage_path('app').'/documentosCLE',$fileName);
            }
            if (request()->has('rfc')) {
                $infoDocente->rfc = $data['rfc']->getClientOriginalName();
                $fileRFC = $data['rfc'];    
                $fileName = $docente->id_docente.$fileRFC->getClientOriginalName();
                $fileRFC->move(storage_path('app').'/documentosCLE',$fileName);
            }
            $infoDocente->grado_estudios = $data['estudios'];
            // $infoDocente->estatus = $data['estatus'];
            $infoDocente->save();
        
        // dd(request()->apMaterno);
        $persona->curp = $data['curp'];
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

        if($usuarioactual->tipo == 'docente'){
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

        $user = User::where('curp_user',$docente[0]->curp_docente)->get();
        // dd($docente,$persona,$user);
        if($user->isNotEmpty()){
            $user[0]->delete();
        }
        if($docente->isNotEmpty()){
            $docente[0]->delete();
        }
        if($persona->isNotEmpty()){
            $persona[0]->delete();
        }
        
        // $clave= $docente->curp_docente;
        // $persona = Persona::where('curp','=', $clave);
        // $persona->delete();
        return redirect()->route('verDocentes')->with('warning','Los datos se eliminaron');
    }

    public function titulo($id,$titulo){
        $p = storage_path('app').'/documentosCLE/'.$id.$titulo;
        return response()->file($p);
    }

    public function rfc($id,$rfc){
        $p = storage_path('app').'/documentosCLE/'.$id.$rfc;
        return response()->file($p);
    }

    public function cedula($id,$cedula){
        $p = storage_path('app').'/documentosCLE/'.$id.$cedula;
        return response()->file($p);
    }

    public function certificaciones($id,$certificacion){
        $p = storage_path('app').'/documentosCLE/'.$id.$certificacion;
        return response()->file($p);
    }

    public function plantilla(){
        $docentes = Docente::where('estatus','Activo')->leftjoin('personas','personas.curp','=','docentes.curp_docente')->get();
        // return view('pdf.plantillapdf',compact('docentes')); setPaper('A4','landscape')->
        $pdfPlantilla =  PDF::loadView('pdf.plantillapdf',compact('docentes'));
        return $pdfPlantilla->download('PlantillaDocentes-'.strftime("%b%Y").'.pdf');
    }
}
