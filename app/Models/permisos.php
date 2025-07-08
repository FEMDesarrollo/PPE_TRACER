<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisos extends Model
{
    use HasFactory;
    protected $table = 'permisos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'permiso',
        'icono',
        'url'
        ];
}
