<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class repuestos extends Model
{
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

}
