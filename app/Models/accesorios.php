<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accesorios extends Model
{
    use HasFactory;
    protected $table = 'accesorios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'imagen',
        'marca',
        'modelo',
        'detalle_descripcion',
        'id_equipo'
        ];

    public function equipo(): mixed
    {
        return $this->belongsTo(equipos::class, 'id_equipo', 'id');
    }

    public static function validationRules(): array
    {
        return [
            'nombre' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30'],
            'marca' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ.\s]+$/u', 'max:20'],
            'modelo' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:20'],
            'detalle_descripcion' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-]+$/u', 'max:255'],
            'id_equipo' => 'required'
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'nombre.max' => 'El nombre no debe exceder los 30 caracteres.',

            'marca.required' => 'La marca es obligatoria.',
            'marca.regex' => 'La marca solo puede contener letras, números, espacios y puntos.',
            'marca.max' => 'La marca no debe exceder los 20 caracteres.',

            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.regex' => 'El modelo solo puede contener letras, números y espacios.',
            'modelo.max' => 'El modelo no debe exceder los 20 caracteres.',

            'detalle_descripcion.required' => 'La descripción es obligatoria.',
            'detalle_descripcion.regex' => 'La descripción solo puede contener letras, números, espacios y guiones.',
            'detalle_descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',

            'id_equipo.required' => 'Debes seleccionar un equipo.',
        ];
    }
}
