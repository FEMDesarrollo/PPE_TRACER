<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estaciones extends Model
{
    use HasFactory;
    protected $table = 'estaciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'total_trajes',
        ];
}