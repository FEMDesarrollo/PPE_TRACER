<?php

namespace App\Http\Requests\Services\EstacionesService;

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
            'direccion'         =>['required','string'],
            'telefono'          =>['required','string','max:10'],
            'total_trajes'      =>['required','integer']
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
            "direccion.required"        => "El campo :attribute es requerido",
            "direccion.string"          => "El campo :attribute debe ser una cadena de texto",
            "telefono.required"         => "El campo :attribute es requerido",
            "telefono.string"           => "El campo :attribute debe ser una cadena de texto",
            "telefono.max"              => "El campo :attribute debe tener maimo 10 caracteres",
            "total_trajes.required"     => "El campo :attribute es requerido",
            "total_trajes.integer"      => "El campo :attribute es de número entero",
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
            'telefono'              => 'Teléfono',
            'total_trajes'          => 'Total de trajes'
        ];
    }
}
