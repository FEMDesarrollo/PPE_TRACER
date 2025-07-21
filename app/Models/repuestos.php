<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class repuestos extends Model
{
    use HasFactory;
    protected $table = 'repuestos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'costo',
        'fecha_disponible',
        'id_prov_servicio',
        'id_accesorio'
        ];

    public function prov_servicio(): mixed
    {
        return $this->belongsTo(proveedorServicio::class, 'id_prov_servicio', 'id');
    }

    public function accesorio(): mixed
    {
        return $this->belongsTo(accesorios::class, 'id_accesorio', 'id');
    }

    public static function validationRules(): array
    {
        return [
            'costo' => ['required', 'numeric', 'between:0,999999.99'],
            'fecha_disponible' => ['required'],
            'id_prov_servicio' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:proveedor_servicios,id'],
            'id_accesorio' => ['required', 'digits_between:1,10', 'regex:/^\d+$/', 'exists:accesorios,id']
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'costo.required' => 'El costo es obligatorio.',
            'costo.numeric' => 'El costo debe ser numérico.',
            'costo.between' => 'El costo está fuera del rango permitido.',

            'fecha_disponible.required' => 'La fecha es obligatoria.',

            'id_prov_servicio.required' => 'El proveedor de servicio es obligatorio.',
            'id_prov_servicio.digits_between' => 'El proveedor de servicio no es válido.',
            'id_prov_servicio.regex' => 'El valor de proveedor de servicio debe contener solo números.',
            'id_prov_servicio.exists' => 'El proveedor de servicio seleccionado no existe.',

            'id_accesorio.required' => 'El accesorio de servicio es obligatorio.',
            'id_accesorio.digits_between' => 'El accesorio de servicio no es válido.',
            'id_accesorio.regex' => 'El valor de accesorio de servicio debe contener solo números.',
            'id_accesorio.exists' => 'El accesorio de servicio seleccionado no existe.',
        ];
    }
}

