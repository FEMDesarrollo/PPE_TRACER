<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    use HasFactory;
    protected $table = 'equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'equipo'
        ];
        

        public static function validationRules(): array
    {
        return [
            'equipo' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30']
        ];
    }

     public static function validationMessages(): array
    {
        return [
            'equipo.required' => 'El equipo es obligatorio.',
            'equipo.regex'    => 'El equipo solo puede contener letras y espacios.',
            'equipo.max'      => 'El equipo no debe exceder los 30 caracteres.'
        ];
    }
}
