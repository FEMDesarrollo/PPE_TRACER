<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gestionInspecciones extends Model
{
    use HasFactory;
    protected $table = 'gestion_inspecciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'observaciones'
        ];

    public static function validationRules(): array
    {
        return [
            'observaciones' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:100']
        ];
    }

     public static function validationMessages(): array
    {
        return [
            'observaciones.required' => 'Las observaciones son obligatorias.',
            'observaciones.regex'    => 'Las observaciones solo puede contener letras y espacios.',
            'observaciones.max'      => 'Las observaciones no debe exceder los 100 caracteres.'
        ];
    }
}
