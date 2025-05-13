<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ControlAsignacion extends Model
{
    use HasFactory, WithCustomScopes, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'control_asignaciones';

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
        'observaciones',
        'fecha_asignacion',
        'fecha_devolucion',
        'id_usuario_equipo',
        'id_estatus_critico'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function usuariosEquipos()
    {
        return $this->hasMany(UsuarioEquipo::class, 'id', 'id_usuario_equipo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function estatusCritico()
    {
        return $this->hasMany(EstatusCritico::class, 'id', 'id_estatus_critico');
    }
}
