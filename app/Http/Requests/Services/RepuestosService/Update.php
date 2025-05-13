<?php

namespace App\Http\Requests\Services\RepuestosService;

use Illuminate\Foundation\Http\FormRequest;

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
        'id'                            =>['required','integer','exists:repuestos,id'],
        'costo'                         =>['numeric','nullable'],
        'fecha_disponibilidad'          =>['date','nullable'],
        'id_prov_servicio'              =>['required','integer','exists:proveedor_servicios,id'],
        'id_accesorio'                  =>['required','integer','exists:accesorios,id']
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
            'costo.numeric'                         => 'El campo :attribute de ser de tipo decimal',
            'fecha_disponibilidad.date'             => 'El campo :attribute debe ser fecha',
            'id_prov_servicio.required'             => "El campo :attribute es requerido",
            'id_prov_servicio.integer'              => "El campo :attribute debe ser de tipo entero",
            'id_prov_servicio.exists'               => "El campo :attribute debe existir en la base de datos",
            'id_accesorio.required'                 => "El campo :attribute es requerido",
            'id_accesorio.integer'                  => "El campo :attribute debe ser de tipo entero",
            'id_accesorio.exists'                   => "El campo :attribute debe existir en la base de datos"
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
            'id'                        =>'Identificador único',
            'costo'                     =>'Costo',
            'fecha_disponibilidad'      =>'Fecha disponible',
            'id_prov_servicio'          =>'Identificador del registro proveedores y servicios',
            'id_accesorio'              =>'Identificador del accesorio'
        ];
    }
}
