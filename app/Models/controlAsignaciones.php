<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class controlAsignaciones extends Model
{
    use HasFactory;
    protected $table = 'control_asignaciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'observaciones',
        'fecha_asignacion',
        'fecha_devolucion',
        'id_usuario_equipo',
        'id_estatus_critico',

        ];

        public function usuarioEquipo(): mixed
    {
        return $this->belongsTo(usuariosEquipos::class, 'id_usuario_equipo');
    }

            public function estatusCritico(): mixed
    {
        return $this->belongsTo(estatusCritico::class, 'id_estatus_critico');
    }

    public static function validationRules(): array
    {
        return [
            'observaciones' => ['required','regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\.,;¿?¡!()\-–—°%"#@$%&+\/\=]+$/u','max:100'],
            'fecha_asignacion' => ['required'],
            'fecha_devolucion' => ['required'],
            'id_usuario_equipo' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:accesorios,id'],
            'id_estatus_critico' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:accesorios,id']
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'observaciones.required' => 'Las observaciones son obligatorias.',
            'observaciones.regex' => 'Las observaciones solo pueden contener letras y espacios.',
            'observaciones.max' => 'Las observaciones no deben exceder los 100 caracteres.',

            'fecha_asignacion.required' => 'La fecha de asignación es obligatoria.',

            'fecha_devolucion.required' => 'La fecha de devolución es obligatoria.',

            'id_usuario_equipo.required' => 'El usuario de equipo es obligatorio.',
            'id_usuario_equipo.digits_between' => 'El usuario de equipo no es válido.',
            'id_usuario_equipo.regex' => 'El usuario de equipo debe contener solo números.',
            'id_usuario_equipo.exists' => 'El usuario de equipo seleccionado no existe.',

            'id_estatus_critico.required' => 'El estatus critico es obligatorio.',
            'id_estatus_critico.digits_between' => 'El estatus critico no es válido.',
            'id_estatus_critico.regex' => 'El estatus critico debe contener solo números.',
            'id_estatus_critico.exists' => 'El estatus critico seleccionado no existe.',

        ];
    }
}
