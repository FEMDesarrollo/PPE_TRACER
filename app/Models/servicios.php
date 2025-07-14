<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicios extends Model
{
    protected $table = 'servicios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'servicio'
    ];

     public static function validationRules(): array
    {
        return [
            'servicio' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'servicio.required' => 'El servicio es obligatorio.',
            'servicio.regex' => 'El servicio solo puede contener letras y espacios.',
            'servicio.max' => 'El nombre no debe exceder los 30 caracteres.'
        ];
    }
}
