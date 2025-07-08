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
}
