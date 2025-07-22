<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallesEstatus extends Model
{
    use HasFactory;
    protected $table = 'detalles_estatus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'total_respuesta',
        'id_estatus',
        'id_usuario',


        ];


        public function estatus_critico(): mixed
    {
        return $this->belongsTo(estatusCritico::class, 'id_estatus');
    }

        public function usuario(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

    public static function validationRules(): array
    {
        return [
            'total_respuesta' => ['required','regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u','max:100'],
            'id_estatus' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:estatus_critico,id'],
            'id_usuario' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:usuarios,id'],

        ];
    }

    public static function validationMessages(): array
    {
        return [
            'total_respuesta.required' => 'El campo total de respuesta es obligatorio.',
            'total_respuesta.regex' => 'Solo se permiten letras y números en el total de respuesta.',
            'total_respuesta.max' => 'El total de respuesta no debe exceder los 100 caracteres.',

            'id_estatus.required' => 'El estatus es obligatorio.',
            'id_estatus.digits_between' => 'El estatus no es válido.',
            'id_estatus.regex' => 'El estatus debe contener solo números.',
            'id_estatus.exists' => 'El estatus seleccionado no existe.',


            'id_usuario.required' => 'El usuario es obligatorio.',
            'id_usuario.digits_between' => 'El usuario no es válido.',
            'id_usuario.regex' => 'El usuario debe contener solo números.',
            'id_usuario.exists' => 'El usuario seleccionado no existe.',

        ];
    }

}

