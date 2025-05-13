<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipo extends Model
{
    use HasFactory, WithCustomScopes, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equipos';

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
        'equipo'
    ];

   /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios()
    {
        return $this->belongsToMany(
            Usuario::class, // Modelo con el que se relaciona
            UsuarioEquipo::class, // Tabla pivote (Intermedia)
            'id_equipo', // Llave foránea de la tabla actual en la tabla pivote
            'id_usuario' // Llave foránea del modelo con el que se relaciona en la tabla pivote
        );
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function accesorios()
    {
        return $this->hasMany(Accesorio::class,'id_equipo', 'id');
    }
}
