<?php

namespace App\Http\Requests\Services\ControlAsignacionesService;

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
            'observaciones'             =>['required','string'],
            'fecha_asignacion'          =>['required','date'],
            'fecha_devolucion'          =>['required','date'],
            'id_usuario_equipo'         =>['required','integer','exists:usuarios_equipos,id'],
            'id_estatus_critico'        =>['required','integer','exists:estatus_critico,id'],
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
            'observaciones.required'                      => "El campo :attribute es Obligatorio",
            'observaciones.string'                        => "El campo :attribute debe ser una cadena de texto",
            'fecha_asignacion.required'                   => "El campo :attribute es Obligatorio",
            'fecha_asignacion.date'                       => "El campo :attribute debe ser fecha",
            'fecha_devolucion.required'                   => "El campo :attribute es Obligatorio",
            'fecha_devolucion.date'                       => "El campo :attribute debe ser fecha",
            'id_usuario_equipo.required'                  => "El campo :attribute es requerido",
            'id_usuario_equipo.integer'                   => "El campo :attribute debe ser de tipo entero",
            'id_usuario_equipo.exists'                    => "El campo :attribute debe existir en la base de datos",
            'id_estatus_critico.required'                 => "El campo :attribute es requerido",
            'id_estatus_critico.integer'                  => "El campo :attribute debe ser de tipo entero",
            'id_estatus_critico.exists'                   => "El campo :attribute debe existir en la base de datos"
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
            'observaciones'                 =>'Observaciones',
            'fecha_asignacion'              =>'Fecha de Asignación',
            'fecha_devolucion'              =>'Fecha de Devolución',
            'id_usuario_equipo'             =>'Identificador del registro de equipos de los usuarios',
            'id_estatus_critico'            =>'Identificador del Estado critico'
        ];
    }
}
