<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string correo
 * @property string password
 */
class Login extends FormRequest
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
            'correo'      => ['required', 'string', 'email', 'exists:usuarios,correo'],
            'password'   => ['required', 'string'],
            // 'rememberMe' => ['nullable', 'boolean']
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
            'correo.required'     => 'El campo :attribute es requerido',
            'correo.string'       => 'El valor del campo :attribute debe ser una cadena de texto',
            'correo.email'        => 'El valor del campo :attribute debe ser un correo electrónico válido',
            'correo.exists'       => 'El valor del campo :attribute no se encuentra en la base de datos',
            'password.required'  => 'El campo :attribute es requerido',
            'password.string'    => 'El valor del campo :attribute debe ser una cadena de texto',
            // 'rememberMe.boolean' => 'El campo :attribute debe ser un valor booleano'
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
            'correo'      => 'correo electrónico',
            'password'   => 'contraseña',
            // 'rememberMe' => 'recuerdame'
        ];
    }
}
