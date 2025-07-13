<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusEquipos extends Model
{
    use HasFactory;
    protected $table = 'estatus_equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'estado'
        ];
    public static function validationRules(): array
    {
        return [
            'estado' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:100']
        ];
    }

     public static function validationMessages(): array
    {
        return [
            'estado.required' => 'El estado es obligatorio.',
            'estado.regex'    => 'El estado solo puede contener letras y espacios.',
            'estado.max'      => 'El estado no debe exceder los 100 caracteres.'
        ];
    }
}
