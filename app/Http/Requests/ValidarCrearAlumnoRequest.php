<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Alumno;
use App\Persona;
use App\User;

class ValidarCrearAlumnoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|alpha_spaces',
            'curp' => array('required','alpha_num','regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/','unique:personas,curp'),
            'apPaterno' => 'required|alpha_spaces',
            'apMaterno' =>'sometimes|nullable|alpha_spaces',
            'calle' => array('sometimes','nullable','regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ,.]*$/'),
            'numero' => 'sometimes|nullable|numeric',
            'colonia' => 'sometimes|nullable|alpha_spaces',
            'municipio' => 'sometimes|nullable',
            'cp' => 'sometimes|nullable|digits:5',
            'telefono' =>'sometimes|nullable|numeric',
            'email' => array('sometimes','nullable','email','regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/','unique:users,email'),
            'edad' =>'required|digits:2',
            'sexo' => 'required',
            'numControl' => array('sometimes','nullable','regex:/^[A-Z]{1}\d{8,10}|\d{8,10}$/','unique:alumnos,num_control'),
            'carrera' => 'sometimes|nullable',
            'semestre' => 'sometimes|nullable'
        ];
    }
}
