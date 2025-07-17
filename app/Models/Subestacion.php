<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subEstacion extends Model
{
    use HasFactory;
    protected $table = 'subestaciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'id_estacion',
        ];

        public function estacion(): mixed
    {
        return $this->belongsTo(estaciones::class, 'id_estacion');
    }

    public static function validationRules(): array
    {
        return [
            'nombre' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:50'],
            'direccion' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\.,&]+$/u', 'max:100'],
            'telefono' => ['required', 'regex:/^[0-9\s\-\(\)\+]{7,20}$/'],
            'id_estacion' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:accesorios,id']

        ];
    }

    public static function validationMessages(): array
    {
        return [
             'nombre.required' => 'El nombre es obligatorio.',
        'nombre.regex' => 'El nombre no es válido.',
        'nombre.max' => 'El nombre es demasiado largo.',

        'direccion.required' => 'La dirección es obligatoria.',
        'direccion.regex' => 'La dirección no es válida.',
        'direccion.max' => 'La dirección es demasiado larga.',

        'telefono.required' => 'El teléfono es obligatorio.',
        'telefono.regex' => 'El teléfono no es válido.',

        'id_estacion.required' => 'La estación es obligatoria.',
        'id_estacion.digits_between' => 'La estación no es válida.',
        'id_estacion.regex' => 'El valor de estacion debe contener solo números.',
        'id_estacion.exists' => 'La estación seleccionado no existe.',

        ];
    }
}
