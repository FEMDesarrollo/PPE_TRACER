<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
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
}
