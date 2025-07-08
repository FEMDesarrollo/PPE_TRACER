<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class controlAsignaciones extends Model
{
    use HasFactory;
    protected $table = 'control_asignaciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'observaciones',
        'fecha_asignacion',
        'fecha_devolucion',
        'id_usuario_equipo',
        'id_estatus_critico',

        ];

        public function usuarioEquipo(): mixed
    {
        return $this->belongsTo(usuariosEquipos::class, 'id_usuario_equipo');
    }

            public function estatusCritico(): mixed
    {
        return $this->belongsTo(estatusCritico::class, 'id_estatus_critico');
    }
}
