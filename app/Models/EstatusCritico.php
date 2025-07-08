<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estatusCritico extends Model
{
    use HasFactory;
    protected $table = 'estatus_critico';
    protected $primaryKey = 'id';
    protected $fillable = [
        'estatus'
        ];
}
