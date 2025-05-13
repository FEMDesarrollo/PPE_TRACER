<?php

namespace App\Http\Requests\Services\ProveedorServiciosService;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property int id_servicio
 * @property int id_servicio
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
            'id'                  =>['required','integer','exists:proveedor_servicios,id'],
            'id_servicio'         =>['required','integer','exists:servicios,id'],
            'id_proveedor'        =>['required','integer','exists:proveedores,id']
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
            'id_servicio.required'                  => "El campo :attribute es requerido",
            'id_servicio.integer'                   => "El campo :attribute debe ser de tipo entero",
            'id_servicio.exists'                    => "El campo :attribute debe existir en la base de datos",
            'id_proveedor.required'                 => "El campo :attribute es requerido",
            'id_proveedor.integer'                  => "El campo :attribute debe ser de tipo entero",
            'id_proveedor.exists'                   => "El campo :attribute debe existir en la base de datos"
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
            'id'                  =>'Identificador único',
            'id_servicio'         =>'Identificador del servicio',
            'id_proveedor'        =>'Identificador del proveedor'
        ];
    }
}
