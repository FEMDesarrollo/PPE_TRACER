<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subestacionEquipos extends Model
{
    use HasFactory;
    protected $table = 'subestaciones_equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_traje',
        'id_equipo',
        'id_estacion',
        'id_subestacion'
        ];

        public function equipo(): mixed
        {
            return $this->belongsTo(equipos::class, 'id_equipo', 'id');
        }

        public function estacion(): mixed
        {
            return $this->belongsTo(estaciones::class, 'id_estacion', 'id');
        }

        public function subestacion(): mixed
        {
            return $this->belongsTo(subEstacion::class, 'id_subestacion', 'id');
        }


    public static function validationRules(): array
    {
        return [
            'no_traje'      => ['required', 'integer', 'min:1'],
            'id_equipo'     => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:equipos,id'],
            'id_estacion'   => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:estaciones,id'],
            'id_subestacion'=> ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:subestaciones,id'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'no_traje.required' => 'El número de traje es obligatorio.',
            'no_traje.integer'  => 'El número de traje debe ser un número entero.',
            'no_traje.min'      => 'El número de traje debe ser al menos 1.',

            'id_equipo.required' => 'El equipo es obligatorio.',
            'id_equipo.digits_between' => 'El equipo no es válido.',
            'id_equipo.regex' => 'El equipo debe contener solo números.',
            'id_equipo.exists' => 'El equipo seleccionado no existe.',

            'id_estacion.required' => 'La estacion es obligatoria.',
            'id_estacion.digits_between' => 'La estacion no es válida.',
            'id_estacion.regex' => 'La estacion debe contener solo números.',
            'id_estacion.exists' => 'La estacion seleccionada no existe.',

            'id_subestacion.required' => 'La subestacion es obligatoria.',
            'id_subestacion.digits_between' => 'La subestacion no es válida.',
            'id_subestacion.regex' => 'La subestacion debe contener solo números.',
            'id_subestacion.exists' => 'La subestacion seleccionada no existe.',
        ];
    }

}
