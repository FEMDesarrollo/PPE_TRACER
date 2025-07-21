<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfiles extends Model
{
    use HasFactory;
    protected $table = 'perfiles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre'
        ];

        public static function validationRules(): array
    {
        return [
            'nombre' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:100']
        ];
    }

     public static function validationMessages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex'    => 'El nombre solo puede contener letras y espacios.',
            'nombre.max'      => 'El nombre no debe exceder los 100 caracteres.'
        ];
    }
}
