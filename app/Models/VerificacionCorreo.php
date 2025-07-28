<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verificacionCorreo extends Model
{
    use HasFactory;
    protected $table = 'verificacion_correo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo_verificacion',
        'fecha',
        'id_usuario',


        ];

        public function usuarios(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario', 'id');
    }

    public static function validationRules(): array
    {
        return [
           'codigo_verificacion' => ['required', 'regex:/^\d+$/', 'max:30'],
            'fecha'              => ['required'],
            'id_usuario'          => ['required', 'digits_between:1,10', 'regex:/^\d+$/']
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'codigo_verificacion.required' => 'El código es obligatorio.',
            'codigo_verificacion.regex' => 'El código solo acepta números.',
            'codigo_verificacion.max' => 'El código es muy largo.',

            'fecha.required' => 'La fecha es obligatoria.',

            'id_usuario.required' => 'El usuario es obligatorio.',
            'id_usuario.digits_between' => 'El usuario no es válido.',
            'id_usuario.regex' => 'El valor de usuario debe contener solo números.',
        ];
    }

}
