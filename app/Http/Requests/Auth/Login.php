<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'correo' => 'required|email',
            'password' => 'required|string|min:4|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email'    => 'El correo no tiene un formato válido.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min'      => 'La contraseña es muy corta.',
            'password.max'      => 'La contraseña es muy larga.',
        ];
    }
}
