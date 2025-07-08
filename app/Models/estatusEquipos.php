<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusEquipos extends Model
{
    use HasFactory;
    protected $table = 'estatus_equipos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'estado'
        ];
}
