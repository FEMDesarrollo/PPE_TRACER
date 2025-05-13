<?php

namespace App\Http\Requests\Services\ProveedoresService;

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
        'nombre'            =>['required','string'],
        'direccion'         =>['string'],
        'telefono'          =>['required','string','max:10'],
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
            "nombre.required"           => "El campo :attribute es requerido",
            "nombre.string"             => "El campo :attribute debe ser una cadena de texto",
            "direccion.string"          => "El campo :attribute debe ser una cadena de texto",
            "telefono.required"         => "El campo :attribute es requerido",
            "telefono.string"           => "El campo :attribute debe ser una cadena de texto",
            "telefono.max"              => "El campo :attribute debe tener maimo 10 caracteres",
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
            'nombre'                => 'Nombre',
            'direccion'             => 'Dirección',
            'telefono'              => 'Teléfono'
        ];
    }
}
