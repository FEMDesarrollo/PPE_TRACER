<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class controlInspecciones extends Model
{
    use HasFactory;
    protected $table = 'control_inspecciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'respuestas',
        'fecha',
        'imagen',
        'descripcion',
        'id_usuario',
        'id_gestion_inspeccion',


        ];

        public function usuarios(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

            public function gestionInspecciones(): mixed
    {
        return $this->belongsTo(gestionInspecciones::class, 'id_gestion_inspeccion');
    }
}
