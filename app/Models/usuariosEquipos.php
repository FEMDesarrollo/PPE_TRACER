<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuariosEquipos extends Model
{
    use HasFactory;
    protected $table = 'usuarios_equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fecha_estatus',
        'comentarios',
        'id_estatus_equipo',
        'id_usuario',
        'id_equipo',


    ];

    public function estatus_equipos(): mixed
    {
        return $this->belongsTo(estatusEquipos::class, 'id_estatus_equipo');
    }

        public function usuarios(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

            public function equipos(): mixed
    {
        return $this->belongsTo(equipos::class, 'id_equipo');
    }

    public static function validationRules(): array
    {
        return [
            'fecha_estatus' => ['required'],
            'comentarios' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ.\s]+$/u', 'max:60'],
            'id_estatus_equipo' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:estatus_equipos,id'],
            'id_usuario' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:usuarios,id'],
            'id_equipo' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:equipos,id']
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'fecha_disponible.required' => 'La fecha es obligatoria.',

            'comentarios.required' => 'El comentario es obligatorio.',
            'comentarios.regex' => 'El comentarios solo puede contener letras y espacios.',
            'comentarios.max' => 'El comentarios no debe exceder los 60 caracteres.',

            'id_estatus_equipo.required' => 'El estatus de equipo es obligatorio.',
            'id_estatus_equipo.digits_between' => 'El estatus de equipo no es válido.',
            'id_estatus_equipo.regex' => 'El estatus de equipo debe contener solo números.',
            'id_estatus_equipo.exists' => 'El estatus de equipo seleccionado no existe.',

            'id_usuario.required' => 'El usuario es obligatorio.',
            'id_usuario.digits_between' => 'El usuario no es válido.',
            'id_usuario.regex' => 'El valor de usuario debe contener solo números.',
            'id_usuario.exists' => 'El usuario seleccionado no existe.',
            
            'id_equipo.required' => 'El equipo es obligatorio.',
            'id_equipo.digits_between' => 'El equipo no es válido.',
            'id_equipo.regex' => 'El valor del equipo debe contener solo números.',
            'id_equipo.exists' => 'El equipo seleccionado no existe.',
        ];
    }
}
