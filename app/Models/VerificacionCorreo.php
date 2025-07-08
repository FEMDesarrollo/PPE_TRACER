<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verificacionCorreo extends Model
{
    use HasFactory;
    protected $table = 'verificacion_correo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo_verificacion',
        'fecha',
        'id_usuario',


        ];

        public function usuarios(): mixed
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

}
