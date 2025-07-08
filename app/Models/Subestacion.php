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
}
