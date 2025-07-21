<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estatusCritico extends Model
{
    use HasFactory;
    protected $table = 'estatus_critico';
    protected $primaryKey = 'id';
    protected $fillable = [
        'estatus'
        ];
    public static function validationRules(): array
    {
        return [
            'estatus' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:100']
        ];
    }

     public static function validationMessages(): array
    {
        return [
            'estatus.required' => 'El estatus es obligatorio.',
            'estatus.regex'    => 'El estatus solo puede contener letras y espacios.',
            'estatus.max'      => 'El estatus no debe exceder los 100 caracteres.'
        ];
    }
}
