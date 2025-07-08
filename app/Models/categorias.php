<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'categoria',
        'id_equipo'
        ];

    public function equipo(): mixed
    {
        return $this->belongsTo(equipos::class, 'id_equipo', 'id');
    }
}
