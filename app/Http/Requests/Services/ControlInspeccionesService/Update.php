<?php

namespace App\Http\Requests\Services\ControlInspeccionesService;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property string respuestas
 * @property string|null imagen
 * @property string|null descripcion
 * @property date fecha
 * @property int id_gestion_inspeccion
 * @property int id_usuario
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
            'id'                        =>['required','integer','exists:control_inspecciones,id'],
            'respuestas'                =>['required','in:si,no'],
            'imagen'                    =>['nullable','string'],
            'descripcion'               =>['nullable','string'],
            'fecha'                     =>['required','date'],
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
            "id.required"                               => "El campo :attribute es requerido",
            "id.integer"                                => "El campo :attribute debe ser de tipo entero",
            "id.exists"                                 => "El campo :attribute debe existir en la base de datos",
            'respuestas.required'                       => "El campo :attribute es Obligatorio",
            'respuestas.in'                             => "El campo :attribute solo puede tener el valor Si o No",
            "imagen.string"                             => "El campo :attribute debe ser una cadena de texto",
            "descripcion.string"                        => "El campo :attribute debe ser una cadena de texto",
            'fecha.required'                            => "El campo :attribute es Obligatorio",
            'fecha.date'                                => "El campo :attribute debe ser fecha",
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
            'respuesta'                     =>'Respuestas',
            'imagen'                        =>'Imagen',
            'descripcion'                   =>'Descripción',
            'fecha'                         =>'Fecha',
        ];
    }
}

