<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'categoria',
        'id_equipo'
        ];

    public function equipo(): mixed
    {
        return $this->belongsTo(equipos::class, 'id_equipo', 'id');
    }

     public static function validationRules(): array
    {
        return [
            'categoria' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:50'],
            'id_equipo' => ['required'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.regex' => 'La categoría solo puede contener letras y espacios.',
            'categoria.max' => 'La categoría no debe exceder los 50 caracteres.',
            'id_equipo.required' => 'Debes seleccionar un equipo.',
        ];
    }
}
