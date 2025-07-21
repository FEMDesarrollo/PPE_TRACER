<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisosUsuarios extends Model
{
    use HasFactory;
    protected $table = 'permisos_usuarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_usuario',
        'id_permiso',
        'activo'
        ];

        public function usuario(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

        public function permiso(): mixed
    {
        return $this->belongsTo(permisos::class, 'id_permiso');
    }

    public static function validationRules(): array
    {
        return [
            'id_usuario' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:usuarios,id'],
            'id_permiso' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:permisos,id'],
            'activo' => ['required', 'in:si,no'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'id_usuario.required' => 'El usuario es obligatorio.',
            'id_usuario.digits_between' => 'El usuario no es válido.',
            'id_usuario.regex' => 'El valor de usuario debe contener solo números.',
            'id_usuario.exists' => 'El usuario seleccionado no existe.',
            
            'id_permiso.required' => 'El permiso es obligatorio.',
            'id_permiso.digits_between' => 'El permiso no es válido.',
            'id_permiso.regex' => 'El valor del permiso debe contener solo números.',
            'id_permiso.exists' => 'El permiso seleccionado no existe.',

            'activo.required' => 'El campo respuestas es obligatorio.',
            'activo.in'       => 'El campo respuestas solo puede contener si o no.',

        ];
    }
}
