<?php

namespace App\Http\Requests\Services\GestionInspeccionesService;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property string observaciones
 */
class Update extends FormRequest
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
            'id'                    =>['required','integer','exists:gestion_inspecciones,id'],
            'observaciones'         =>['required', 'string']
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
            "id.required"                      => "El campo :attribute es requerido",
            "id.integer"                       => "El campo :attribute debe ser de tipo entero",
            "id.exists"                        => "El campo :attribute debe existir en la base de datos",
            "observaciones.required"           => "El campo :attribute es requerido",
            "observaciones.string"             => "El campo :attribute debe ser una cadena de texto",
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
            'id'                            =>'Identificador único',
            'observaciones'                 =>'Observaciones de inspecciones'
        ];
    }
}
