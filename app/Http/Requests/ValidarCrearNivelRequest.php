<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarCrearNivelRequest extends FormRequest
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
            'nivel' => array('required','regex:/^[ABCabc][12]$/'),
            'modulo' => array('required','regex:/^[Mm][12]$/'),
            'idioma' => 'required|alpha_spaces',
            
        ];
    }
}
