<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuariosEquipos extends Model
{
    use HasFactory;
    protected $table = 'usuarios_equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fecha_estatus',
        'comentarios',
        'id_estatus_equipo',
        'id_usuario',
        'id_equipo',


        ];
public function estatus_equipos(): mixed
    {
        return $this->belongsTo(estatusEquipos::class, 'id_estatus_equipo');
    }

        public function usuarios(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

            public function equipos(): mixed
    {
        return $this->belongsTo(equipos::class, 'id_equipo');
    }
}
