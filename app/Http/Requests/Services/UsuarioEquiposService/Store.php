<?php

namespace App\Http\Requests\Services\UsuarioEquiposService;

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
            'fecha_estatus' => ['required', 'date'],
            'comentarios' => ['required', 'string'],
            'id_estatus_equipo' => ['required', 'integer', 'exists:estatus_equipos,id'],
            'id_usuario' => ['required', 'integer', 'exists:usuarios,id'],
            'id_equipo' => ['required', 'integer', 'exists:equipos,id']
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
            'fecha.required'                        => 'El campo :attribute es Obligatorio',
            'fecha.date'                            => 'El campo :attribute debe ser fecha',
            'direccion.required'                    => 'El campo :attribute es requerido',
            'direccion.string'                      => 'El campo :attribute debe ser una cadena de texto',
            'id_estatus_equipo.required'            => 'El campo :attribute es requerido',
            'id_estatus_equipo.integer'             => 'El campo :attribute debe ser de tipo entero',
            'id_estatus_equipo.exists'              => 'El campo :attribute debe existir en la base de datos',
            'id_usuario.required'                   => 'El campo :attribute es requerido',
            'id_usuario.integer'                    => 'El campo :attribute debe ser de tipo entero',
            'id_usuario.exists'                     => 'El campo :attribute debe existir en la base de datos',
            'id_equipo.required'                    => 'El campo :attribute es requerido',
            'id_equipo.integer'                     => 'El campo :attribute debe ser de tipo entero',
            'id_equipo.exists'                      => 'El campo :attribute debe existir en la base de datos',
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
            'fecha_estatus'             => 'Fecha del Estado del Equipo',
            'comentarios'               => 'Comentarios',
            'id_estatus_equipo'         => 'Identificado del estado del Equipo',
            'id_usuario'                => 'Identificado del Usuario',
            'id_equipo'                 => 'Identificado del Equipo',
        ];
    }
}
