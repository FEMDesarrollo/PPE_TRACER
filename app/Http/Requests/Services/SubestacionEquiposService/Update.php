<?php

namespace App\Http\Requests\Services\SubestacionEquiposService;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property int no_traje
 * @property int id_equipo
 * @property int id_estacion
 * @property int id_subestacion
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
            'id'                =>['required','integer','exists:subestacion_equipos,id'],
            'no_traje'          =>['nullable','integer'],
            'id_equipo'         =>['required','integer','exists:equipos,id'],
            'id_estacion'       =>['required','integer','exists:estaciones,id'],
            'id_subestacion'    =>['required','integer','exists:subestaciones,id']
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
            "no_traje.integer"          => "El campo :attribute debe ser de tipo entero",
            "id_equipo.required"        => "El campo :attribute es requerido",
            "id_equipo.integer"         => "El campo :attribute debe ser de tipo entero",
            "id_equipo.exists"          => "El campo :attribute debe existir en la base de datos",
            "id_estacion.required"      => "El campo :attribute es requerido",
            "id_estacion.integer"       => "El campo :attribute debe ser de tipo entero",
            "id_estacion.exists"        => "El campo :attribute debe existir en la base de datos",
            "id_subestacion.required"   => "El campo :attribute es requerido",
            "id_subestacion.integer"    => "El campo :attribute debe ser de tipo entero",
            "id_subestacion.exists"     => "El campo :attribute debe existir en la base de datos"
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
            'id'                          =>'Identificador único',
            'no_traje'                    => 'Número de trajes',
            'id_equipo'                   => 'Identificador del traje',
            'id_estacion'                 => 'Identificador de la estación',
            'id_subestacioon'             => 'Identificador de la subestación',
        ];
    }
}
