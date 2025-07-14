<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class controlInspecciones extends Model
{
    use HasFactory;
    protected $table = 'control_inspecciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'respuestas',
        'fecha',
        'imagen',
        'descripcion',
        'id_usuario',
        'id_gestion_inspeccion',


        ];

        public function usuarios(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

            public function gestionInspecciones(): mixed
    {
        return $this->belongsTo(gestionInspecciones::class, 'id_gestion_inspeccion');
    }

    public static function validationRules(): array
    {
        return [
            'respuestas'            => ['required', 'in:si,no'],
            'descripcion'           => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:50'],
            'fecha'                 => ['required'],
            'id_usuario'            => ['required', 'integer', 'exists:usuarios,id'],
            'id_gestion_inspeccion' => ['required', 'integer', 'exists:gestion_inspecciones,id'],
        ];
    }


    public static function validationMessages(): array
    {
        return [
            'respuestas.required' => 'El campo respuestas es obligatorio.',
            'respuestas.in'       => 'El campo respuestas solo puede contener si o no.',


            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.regex'    => 'La descripción solo puede contener letras y espacios.',
            'descripcion.max'      => 'La descripción no debe exceder los 50 caracteres.',

            'fecha.required' => 'La fecha es obligatoria.',

            'id_usuario.required' => 'El usuario es obligatorio.',
            'id_usuario.integer'  => 'El ID del usuario debe ser un número.',
            'id_usuario.exists'   => 'El usuario no existe en la base de datos.',

            'id_gestion_inspeccion.required' => 'La inspección es obligatoria.',
            'id_gestion_inspeccion.integer'  => 'El ID de gestión debe ser un número.',
            'id_gestion_inspeccion.exists'   => 'La gestión de inspección no existe en la base de datos.',
        ];
    }

}
