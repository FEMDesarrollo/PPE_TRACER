<?php

namespace App\Http\Requests\Services\SubestacionesService;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property string nombre
 * @property string direccion
 * @property string telefono
 * @property int id_estacion
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
            'id'        =>['required','integer','exists:subestaciones,id'],
            'nombre'            =>['required','string'],
            'direccion'         =>['required','string'],
            'telefono'          =>['required','string','max:10'],
            'id_estacion'      => ['required', 'integer', 'exists:estaciones,id'],
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
            "id.required"               => "El campo :attribute es requerido",
            "id.integer"                => "El campo :attribute debe ser de tipo entero",
            "id.exists"                 => "El campo :attribute debe existir en la base de datos",
            "nombre.required"           => "El campo :attribute es requerido",
            "nombre.string"             => "El campo :attribute debe ser una cadena de texto",
            "direccion.required"        => "El campo :attribute es requerido",
            "direccion.string"          => "El campo :attribute debe ser una cadena de texto",
            "telefono.required"         => "El campo :attribute es requerido",
            "telefono.string"           => "El campo :attribute debe ser una cadena de texto",
            "telefono.max"              => "El campo :attribute debe tener maimo 10 caracteres",
            "id_estacion.required"      => "El campo :attribute es requerido",
            "id_estacion.integer"       => "El campo :attribute debe ser de tipo entero",
            "id_estacion.exists"        => "El campo :attribute debe existir en la base de datos",

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
            'id'                    =>'Identificador único',
            'nombre'                => 'Nombre',
            'direccion'             => 'Dirección',
            'telefono'              => 'Teléfono',
            'id_estacion'           => 'Identificador de la Estación'
        ];
    }
}
