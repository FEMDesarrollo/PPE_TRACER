<?php

namespace App\Http\Requests\Services\DetalleEquiposService;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property string modelo
 * @property string no_serie
 * @property string talla
 * @property int piezas
 * @property date fecha_fabricacion
 * @property int id_usuario_equipo
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
        'id'                            =>['required','integer','exists:detalles_equipos,id'],
        'modelo'                        =>['required','string'],
        'no_serie'                      =>['required','string'],
        'talla'                         =>['required','string'],
        'piezas'                        =>['required','integer'],
        'fecha_fabricacion'             =>['required','date'],
        'id_usuario_equipo'             =>['required','integer','exists:usuarios_equipos,id']
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
            'modelo.required'                       => "El campo :attribute es Obligatorio",
            'modelo.string'                         => "El campo :attribute debe ser una cadena de texto",
            'no_serie.required'                     => "El campo :attribute es Obligatorio",
            'no_serie.string'                       => "El campo :attribute debe ser una cadena de texto",
            'talla.required'                        => "El campo :attribute es Obligatorio",
            'talla.string'                          => "El campo :attribute debe ser una cadena de texto",
            'fecha_fabricacion.required'            => "El campo :attribute es Obligatorio",
            'fecha_fabricacion.date'                => "El campo :attribute debe ser fecha",
            'id.required'                           => "El campo :attribute es requerido",
            'id.integer'                            => "El campo :attribute debe ser de tipo entero",
            'id.exists'                             => "El campo :attribute debe existir en la base de datos"
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
            'modelo'                =>'Modelo',
            'no_serie'              =>'Número de Serie',
            'talla'                 =>'Talla',
            'fecha_fabricacion'     =>'Fecha de Fabricación'
        ];
    }
}
