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
            'nombre'        => ['required', 'max:255'],
            'direccion'     => ['required', 'string', 'max:255'],
            'telefono'      => ['required', 'regex:/^[0-9]{10}$/'],
            'total_trajes'  => ['required', 'integer', 'min:0'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'nombre.required'       => 'El nombre es obligatorio.',
            'nombre.max'            => 'El nombre no debe exceder los 255 caracteres.',

            'direccion.required'    => 'La dirección es obligatoria.',
            'direccion.max'         => 'La dirección no debe exceder los 255 caracteres.',

            'telefono.required'     => 'El teléfono es obligatorio.',
            'telefono.regex'        => 'El teléfono debe contener exactamente 10 dígitos numéricos.',

            'total_trajes.required' => 'El total de trajes es obligatorio.',
            'total_trajes.integer'  => 'El total de trajes debe ser un número entero.',
            'total_trajes.min'      => 'El total de trajes no puede ser negativo.',
        ];
    }
}
