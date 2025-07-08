<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accesorios extends Model
{
    use HasFactory;
    protected $table = 'accesorios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'imagen',
        'marca',
        'modelo',
        'detalle_descripcion',
        'id_equipo'
        ];

    public function equipo(): mixed
    {
        return $this->belongsTo(equipos::class, 'id_equipo', 'id');
    }
}
