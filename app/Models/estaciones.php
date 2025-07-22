<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estaciones extends Model
{
    use HasFactory;

    protected $table = 'estaciones';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'total_trajes',
    ];

    public static function validationRules(): array
    {
        return [
            'nombre'         => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s().]+$/u', 'max:150'],
            'direccion' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\.,&]+$/u', 'max:100'],
            'telefono'       => ['required', 'regex:/^[0-9\s\-\(\)\+]{7,20}$/'],
            'total_trajes'  => ['required', 'integer', 'min:0'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.regex'    => 'El campo nombre no es válido.',
            'nombre.max'      => 'El campo nombre es muy largo.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.regex'    => 'La dirección solo puede contener letras, números, guiones,comas y espacios.',
            'direccion.max'      => 'La dirección no debe exceder los 150 caracteres.',

            'telefono.required'     => 'El teléfono es obligatorio.',
            'telefono.regex'        => 'El teléfono debe contener exactamente 10 dígitos numéricos.',

            'total_trajes.required' => 'El total de trajes es obligatorio.',
            'total_trajes.integer'  => 'El total de trajes debe ser un número entero.',
            'total_trajes.min'      => 'El total de trajes no puede ser negativo.',
        ];
    }
}
