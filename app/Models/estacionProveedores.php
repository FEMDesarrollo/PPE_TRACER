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

}
