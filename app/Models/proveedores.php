<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedores extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono'
        ];

        public static function validationRules(): array
    {
        return [
            'nombre' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.,]+$/u', 'max:50'],
            'direccion' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s,\-]+$/u', 'max:150'],
            'telefono' => ['required', 'regex:/^[0-9\-\(\)\s]+$/', 'max:15']
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex'    => 'El nombre solo puede contener letras y espacios.',
            'nombre.max'      => 'El nombre no debe exceder los 30 caracteres.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.regex'    => 'La dirección solo puede contener letras, números, guiones,comas y espacios.',
            'direccion.max'      => 'La dirección no debe exceder los 150 caracteres.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex'    => 'El teléfono solo puede contener números, guiones, parentesis y debe tener 15 dígitos.',
        ];
    }
}
