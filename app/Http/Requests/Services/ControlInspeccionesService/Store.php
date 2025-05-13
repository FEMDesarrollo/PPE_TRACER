<?php

namespace App\Http\Requests\Services\ControlInspeccionesService;

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
            'respuestas'                =>['required','in:si,no'],
            'imagen'                    =>['nullable','string'],
            'descripcion'               =>['nullable','string'],
            'fecha'                     =>['required','date'],
            'id_gestion_inspeccion'     =>['required','integer','exists:gestion_inspecciones,id'],
            'id_usuario'                =>['required','integer','exists:usuarios,id']


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
            'respuestas.required'                       => "El campo :attribute es Obligatorio",
            'respuestas.in'                             => "El campo :attribute solo puede tener el valor Si o No",
            "imagen.string"                             => "El campo :attribute debe ser una cadena de texto",
            "descripcion.string"                        => "El campo :attribute debe ser una cadena de texto",
            'fecha.required'                            => "El campo :attribute es Obligatorio",
            'fecha.date'                                => "El campo :attribute debe ser fecha",
            "id_gestion_inspeccion.required"            => "El campo :attribute es requerido",
            "id_gestion_inspeccion.integer"             => "El campo :attribute debe ser de tipo entero",
            "id_gestion_inspeccion.exists"              => "El campo :attribute debe existir en la base de datos",
            "id_usuario.required"                       => "El campo :attribute es requerido",
            "id_usuario.integer"                        => "El campo :attribute debe ser de tipo entero",
            "id_usuario.exists"                         => "El campo :attribute debe existir en la base de datos",

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
            'respuesta'                     =>'Respuestas',
            'imagen'                        =>'Imagen',
            'descripcion'                   =>'Descripción',
            'fecha'                         =>'Fecha',
            'id_gestion_inspeccion'         =>'Identificador de la inspeccion',
            'id_usuario'                    =>'Identificador del Usuario',
        ];
    }
}
