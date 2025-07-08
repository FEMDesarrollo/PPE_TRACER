<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallesEquipo extends Model
{
    use HasFactory;
    protected $table = 'detalles_equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'modelo',
        'no_serie',
        'talla',
        'piezas',
        'fecha_fabricacion',
        'id_usuario_equipo',
        ];

        public function usuarios_equipos(): mixed
    {
        return $this->belongsTo(usuariosEquipos::class, 'id_usuario_equipo');
    }
}
