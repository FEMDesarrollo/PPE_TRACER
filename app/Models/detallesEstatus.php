<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallesEstatus extends Model
{
    use HasFactory;
    protected $table = 'detalles_estatus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'total_respuesta',
        'id_estatus',
        'id_usuario',
                            

        ];


        public function estatus_critico(): mixed
    {
        return $this->belongsTo(estatusCritico::class, 'id_estatus');
    }

        public function usuario(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

}
