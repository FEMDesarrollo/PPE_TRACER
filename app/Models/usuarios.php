<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rule;

class usuarios extends  Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'app',
        'apm',
        'telefono',
        'correo',
        'password',
        'foto',
        'id_estacion',
        'id_subestacion',
        'id_perfil',
        'correo_verificado',
    ];

    public function estacion(): mixed
    {
        return $this->belongsTo(estaciones::class, 'id_estacion');
    }

    public function subestacion(): mixed
    {
        return $this->belongsTo(subEstacion::class, 'id_subestacion');
    }

    public function perfil(): mixed
    {
        return $this->belongsTo(perfiles::class, 'id_perfil');
    }
    
    public function verificacionCorreo()
    {
        return $this->hasOne(VerificacionCorreo::class, 'id_usuario', 'id');
    }

    
    public static function validationRules($id = null): array
    {
        return [
            'nombre'         => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s().]+$/u', 'max:50'],
            'app'            => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s.]+$/u', 'max:50'],
            'apm'            => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s.]+$/u', 'max:50'],
            'telefono'       => ['required', 'regex:/^[0-9\s\-\(\)\+]{7,20}$/'],
            'correo'         => ['required', 'email', 'max:100', 'unique:usuarios,correo,' . $id],
            'password'       => ['required', 'min:4', 'max:20'],
            'id_estacion'    => ['required', 'digits_between:1,10', 'regex:/^\d+$/'],
            'id_subestacion' => ['required', 'digits_between:1,10', 'regex:/^\d+$/'],
            'id_perfil'      => ['required', 'digits_between:1,10', 'regex:/^\d+$/'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.regex'    => 'El campo nombre no es válido.',
            'nombre.max'      => 'El campo nombre es muy largo.',

            'app.required' => 'El campo apellido paterno es obligatorio.',
            'app.regex'    => 'El campo apellido paterno no es válido.',
            'app.max'      => 'El campo apellido paterno es muy largo.',

            'apm.required' => 'El campo apellido materno es obligatorio.',
            'apm.regex'    => 'El campo apellido materno no es válido.',
            'apm.max'      => 'El campo apellido materno es muy largo.',

            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.regex'    => 'El campo teléfono no es válido.',

            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email'    => 'El campo correo no es válido.',
            'correo.max'      => 'El campo correo es muy largo.',
            'correo.unique'   => 'El campo correo ya está registrado.',

            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min'      => 'El campo contraseña es muy corto.',
            'password.max'      => 'El campo contraseña es muy largo.',

            'id_estacion.required'        => 'El campo estación es obligatorio.',
            'id_estacion.digits_between' => 'El campo estación no es válido.',
            'id_estacion.regex'          => 'El campo estación debe ser numérico.',

            'id_subestacion.required'        => 'El campo subestación es obligatorio.',
            'id_subestacion.digits_between' => 'El campo subestación no es válido.',
            'id_subestacion.regex'          => 'El campo subestación debe ser numérico.',

            'id_perfil.required'        => 'El campo perfil es obligatorio.',
            'id_perfil.digits_between' => 'El campo perfil no es válido.',
            'id_perfil.regex'          => 'El campo perfil debe ser numérico.',
        ];
    }
}
