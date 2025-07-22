<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisos extends Model
{
    use HasFactory;
    protected $table = 'permisos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'permiso',
        'icono',
        'url'
        ];

        public static function validationRules(): array
    {
        return [
             'permiso' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:50'],
             'url' => 'required'
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'permiso.required' => 'El permiso es obligatorio.',
            'permiso.regex' => 'El permiso solo puede contener letras y espacios.',
            'permiso.max' => 'El nombre es demasiado largo.',

            'url.required' => 'La URL es obligatoria.',
        ];
    }
}
