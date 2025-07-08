<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subestacionEquipos extends Model
{
    use HasFactory;
    protected $table = 'subestaciones_equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_traje',
        'id_equipo',
        'id_estacion',
        'id_subestacion'
        ];

        public function equipo(): mixed
        {
            return $this->belongsTo(equipos::class, 'id_equipo', 'id');
        }

        public function estacion(): mixed
        {
            return $this->belongsTo(estaciones::class, 'id_estacion', 'id');
        }

        public function subestacion(): mixed
        {
            return $this->belongsTo(subEstacion::class, 'id_subestacion', 'id');
        }
}
