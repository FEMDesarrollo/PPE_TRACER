<?php

namespace App\Http\Requests\Services\ProveedoresService;

use Illuminate\Foundation\Http\FormRequest;

class Show extends FormRequest
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
            'id'        =>['required','integer','exists:proveedores,id']
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
            'id'        =>'Identificador único'
        ];
    }
}
