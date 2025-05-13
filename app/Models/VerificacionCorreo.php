<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerificacionCorreo extends Model
{
    use HasFactory, WithCustomScopes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'verificacion_correo';

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
        'fecha',
        'codigo_verificacion',
        'id_usuario'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function usuarios()
    {
        return $this->belongsTo(Usuario::class,  'id', 'id_usuario');
    }
}
