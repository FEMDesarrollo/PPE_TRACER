<?php

namespace App\Http\Requests\Services\AccesoriosService;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property string nombre
 * @property string imagen
 * @property string marca
 * @property string modelo
 * @property string detalle_descripcion
 * @property int id_equipo
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
        'id'                            =>['required','integer','exists:accesorios,id'],
        'nombre'                        =>['required','string'],
        'imagen'                        =>['string'],
        'marca'                         =>['required','string'],
        'modelo'                        =>['required','string'],
        'detalle_descripcion'           =>['required','string'],
        'id_equipo'                     =>['required','integer','exists:equipos,id']
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
            'id.required'                           => "El campo :attribute es requerido",
            'id.integer'                            => "El campo :attribute debe ser de tipo entero",
            'id.exists'                             => "El campo :attribute debe existir en la base de datos",
            'nombre.required'                       => "El campo :attribute es Obligatorio",
            'nombre.string'                         => "El campo :attribute debe ser una cadena de texto",
            'imagen.string'                         => "El campo :attribute debe ser una cadena de texto",
            'marca.required'                        => "El campo :attribute es Obligatorio",
            'marca.string'                          => "El campo :attribute debe ser una cadena de texto",
            'modelo.required'                       => "El campo :attribute es Obligatorio",
            'modelo.string'                         => "El campo :attribute debe ser una cadena de texto",
            'detalle_descripcion.required'          => "El campo :attribute es Obligatorio",
            'detalle_descripcion.string'            => "El campo :attribute debe ser una cadena de texto",
            'id_equipo.required'                    => "El campo :attribute es requerido",
            'id_equipo.integer'                     => "El campo :attribute debe ser de tipo entero",
            'id_equipo.exists'                      => "El campo :attribute debe existir en la base de datos"
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
        'nombre'                =>'Nombre',
        'imagen'                =>'Imagen',
        'marca'                 =>'Marca',
        'modelo'                =>'Modelo',
        'detalle_descripcion'   =>'Descripción detallada',
        'id_equipo'             =>'Identificador del Equipo'
        ];
    }
}
