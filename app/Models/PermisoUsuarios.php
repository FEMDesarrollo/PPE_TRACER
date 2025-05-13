<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermisoUsuarios extends Model
{
    use HasFactory, WithCustomScopes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permisos_usuarios';

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
        'id_usuario',
        'id_permiso'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function permisos()
    {
        return $this->belongsTo(Permiso::class, 'id_permiso', 'id');
    }
}
