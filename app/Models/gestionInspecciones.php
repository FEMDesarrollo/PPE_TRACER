<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gestionInspecciones extends Model
{
    use HasFactory;
    protected $table = 'gestion_inspecciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'observaciones'
        ];
}
