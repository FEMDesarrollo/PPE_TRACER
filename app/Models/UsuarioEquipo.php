<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsuarioEquipo extends Model
{
    use HasFactory, WithCustomScopes, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuarios_equipos';

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
        'fecha_estatus',
        'comentarios',
        'id_estatus_equipo',
        'id_usuario',
        'id_equipo'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function estatusEquipo()
    {
        return $this->hasOne(EstatusEquipo::class, 'id', 'id_estatus_equipo');
    }


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
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function controlAsignacion()
    {
        return $this->belongsTo(ControlAsignacion::class,'id_usuario_equipo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function detallesEquipos()
    {
        return $this->belongsTo(DetalleEquipo::class,'id_usuario_equipo', 'id');
    }
}
