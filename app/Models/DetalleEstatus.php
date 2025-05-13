<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleEstatus extends Model
{
    use HasFactory, WithCustomScopes, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detalles_estatus';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Timestamps
     *
     * @var string
     */
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_respuesta',
        'id_estatus',
        'id_usuario'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function estatusCritico()
    {
        return $this->hasOne(EstatusCritico::class, 'id', 'id_estatus');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function usuario()
    {
        return $this->hasMany(Usuario::class, 'id', 'id_usuario');
    }
}
