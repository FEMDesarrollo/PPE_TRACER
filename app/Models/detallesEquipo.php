<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallesEquipo extends Model
{
    use HasFactory;
    protected $table = 'detalles_equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'modelo',
        'no_serie',
        'talla',
        'piezas',
        'fecha_fabricacion',
        'id_usuario_equipo',
        ];

        public function usuarios_equipos(): mixed
    {
        return $this->belongsTo(usuariosEquipos::class, 'id_usuario_equipo');
    }

    public static function validationRules(): array
    {
        return [
            'modelo' => ['required','regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u','max:50'],
            'no_serie' => ['required','regex:/^[A-Za-z0-9\-ÁÉÍÓÚáéíóúÑñ\s]+$/u','max:100'],
            'talla' => ['required','regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u','max:10'],
            'piezas' => ['required','integer','min:1'],
            'fecha_fabricacion' => ['required'],
            'id_usuario_equipo' => ['required']
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.regex' => 'El modelo solo puede contener letras, números y espacios.',
            'modelo.max' => 'El modelo no debe exceder los 50 caracteres.',

            'no_serie.required' => 'El número de serie es obligatorio.',
            'no_serie.regex' => 'El número de serie solo puede contener letras, números, guiones y espacios.',
            'no_serie.max' => 'El número de serie no debe exceder los 100 caracteres.',

            'talla.required' => 'La talla es obligatoria.',
            'talla.regex' => 'La talla solo puede contener letras, números y espacios.',
            'talla.max' => 'La talla no debe exceder los 10 caracteres.',

            'piezas.required' => 'El número de piezas es obligatorio.',
            'piezas.integer' => 'El número de piezas debe ser un número entero.',
            'piezas.min' => 'El número de piezas debe ser al menos 1.',

            'fecha_fabricacion.required' => 'La fecha de fabricación es obligatoria.',

            'id_usuario_equipo.required' => 'Debes seleccionar un usuario de equipo.'
        ];
    }
}
