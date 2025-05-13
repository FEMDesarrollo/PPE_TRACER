<?php

namespace App\Http\Requests\Services\GestionInspeccionesService;

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
            'observaciones'                 =>'Observaciones de inspecciones'
        ];
    }
}
