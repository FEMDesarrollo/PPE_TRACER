<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisosUsuarios extends Model
{
    use HasFactory;
    protected $table = 'permisos_usuarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_usuario',
        'id_permiso',
        'activo'
        ];

        public function usuario(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

        public function permiso(): mixed
    {
        return $this->belongsTo(permisos::class, 'id_permiso');
    }
}
