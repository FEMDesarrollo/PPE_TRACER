<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class proveedorServicio extends Model
{
    use HasFactory;
    protected $table = 'proveedor_servicios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_servicio',
        'id_proveedor'
        ];

        public function servicio(): mixed
    {
        return $this->belongsTo(servicios::class, 'id_servicio', 'id');
    }

     public function proveedor(): mixed
    {
        return $this->belongsTo(proveedores::class, 'id_proveedor', 'id');
    }

    public static function validationRules(): array
    {
        return [
            'id_servicio' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:servicios,id'],
            'id_proveedor' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:proveedores,id']

        ];
    }

    public static function validationMessages(): array
    {
        return [

            'id_servicio.required' => 'El servicio es obligatorio.',
            'id_servicio.digits_between' => 'El servicio no es válido.',
            'id_servicio.regex' => 'El servicio debe contener solo números.',
            'id_servicio.exists' => 'El servicio seleccionado no existe.',

            'id_proveedor.required' => 'El proveedor es obligatorio.',
            'id_proveedor.digits_between' => 'El proveedor no es válido.',
            'id_proveedor.regex' => 'El proveedor debe contener solo números.',
            'id_proveedor.exists' => 'El proveedor seleccionado no existe.',

        ];
    }
}
