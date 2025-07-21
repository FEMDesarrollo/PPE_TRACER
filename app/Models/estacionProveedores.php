<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estacionProveedores extends Model
{
    use HasFactory;
    protected $table = 'estacion_proveedores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_proveedor',
        'id_estacion',
        ];

        public function proveedor(): mixed
    {
        return $this->belongsTo(proveedores::class, 'id_proveedor');
    }

        public function estacion(): mixed
    {
        return $this->belongsTo(estaciones::class, 'id_estacion');
    }

     public static function validationRules(): array
    {
        return [
            'id_proveedor' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:proveedores,id'],
            'id_estacion' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:estaciones,id']
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'id_proveedor.required' => 'El proveedor es obligatorio.',
            'id_proveedor.digits_between' => 'El proveedor no es válido.',
            'id_proveedor.regex' => 'El valor de proveedor debe contener solo números.',
            'id_proveedor.exists' => 'El proveedor seleccionado no existe.',

            'id_estacion.required' => 'La estación es obligatoria.',
            'id_estacion.digits_between' => 'La estación no es válida.',
            'id_estacion.regex' => 'La estación debe contener solo números.',
            'id_estacion.exists' => 'La estación seleccionada no existe.',
        ];
    }
}
