<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ValidarCrearUsuarioRequest;
use App\Persona;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $personas = Persona::where('tipo','coordinador')
                    ->withTrashed()
                    ->get();
        // dd($personas);
        return view('users.show',compact('personas'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ValidarCrearUsuarioRequest $request)
    {
        $data = request()->all();
        
        Persona::firstOrCreate([
            'curp' => $data['curp'],
            'nombres' => $data['name'],
            'ap_paterno' => $data['apPaterno'],
            'ap_materno' => $data['apMaterno'],
            'tipo' => $data['tipo'],
            'edad' => 0,
            'sexo' => 'M',
        ]);

        $persona = Persona::find($data['curp']);
        $persona->tipo = $data['tipo'];
        $persona->save();

        User::firstOrCreate([
            'curp_user' => $data['curp'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'tipo' => $data['tipo']
        ]);
        // $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('home')->with('success','Usuario Coordinador creado correctamente.');
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit($user)
    {
        $user = User::withTrashed()->where('curp_user',$user)->leftjoin('personas','personas.curp','=','users.curp_user')->first();
    //    dd($user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        // $user->update(
        //     $request->merge(['password' => Hash::make($request->get('password'))])
        //         ->except([$request->get('password') ? '' : 'password']
        // ));

        $data = request()->validate([
            'name' => 'required|alpha_spaces',
            'curp' => array('required','alpha_num','regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'),
            'apPaterno' => 'required|alpha_spaces',
            'apMaterno' =>'sometimes|nullable|alpha_spaces',
            'email' => array('sometimes','nullable','email','regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/'),
            'estatus' => 'required',
            'password' => ['sometimes','nullable', 'min:6', 'confirmed'],
            'password_confirmation' => ['sometimes','nullable', 'min:6']
        ]);
        // dd($data);
        $persona = Persona::withTrashed()->find($data['curp']);
        $persona->nombres = $data['name'];
        $persona->ap_paterno = $data['apPaterno'];
        $persona->ap_materno = $data['apMaterno'];
        

        $usuario = User::withTrashed()->where('curp_user',$data['curp'])->first();
        $usuario->email = $data['email'];
        $usuario->name = $data['name'];
        if($data['password'] != null){
            $usuario->password = bcrypt($data['password']);
        }
        if($data['estatus'] == 'activo'){
            $usuario->deleted_at = null;
            $persona->deleted_at = null;
        }else{
            $usuario->deleted_at = date("Y-m-d H:i:s");
            $persona->deleted_at = date("Y-m-d H:i:s");
        }
        $persona->save();
        $usuario->save();
        return redirect()->route('verUsuarios')->with('success','El usuario se actualizo correctamente.');
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
