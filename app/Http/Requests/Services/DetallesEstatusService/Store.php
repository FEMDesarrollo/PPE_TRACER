<?php

namespace App\Http\Requests\Services\DetallesEstatusService;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'total_respuesta'            =>['required','numeric'],
            'id_estatus'                 =>['required','integer','exists:estatus_critico,id'],
            'id_usuario'                 =>['required','integer','exists:usuarios,id']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
        'totalespuesta_r.required'                           => 'El campo :attribute es requerido',
        'totalespuesta_r.numeric'                            => 'El campo :attribute de ser de tipo decimal',
        "id_estatus.required"                                => "El campo :attribute es requerido",
        "id_estatus.integer"                                 => "El campo :attribute debe ser de tipo entero",
        "id_estatus.exists"                                  => "El campo :attribute debe existir en la base de datos",
        "id_usuario.required"                                => "El campo :attribute es requerido",
        "id_usuario.integer"                                 => "El campo :attribute debe ser de tipo entero",
        "id_usuario.exists"                                  => "El campo :attribute debe existir en la base de datos",
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'total_respuesta'               => 'Total de las respuestas',
            'id_estatus'                    => 'Identificador del estado critico',
            'id_usuario'                    => 'Identificador del usuario'
        ];
    }
}
