<?php

namespace App\Models;

use App\Traits\Models\WithCustomScopes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int id
 * @property string nombre
 * @property string app
 * @property string apm
 * @property string correo
 * @property string password
 * @property int id_perfil
 * @property int id_estacion
 * @property int id_subestacion
 * @property \App\Models\Estacion estacion
 * @property \App\Models\Subestacion subestacion
 * @property \App\Models\Perfil perfil
 */
class Usuario extends Authenticatable
{
    use WithCustomScopes, HasApiTokens;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuarios';

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
        'nombre',
        'app',
        'apm',
        'telefono',
        'correo',
        'password',
        'foto',
        'id_estacion',
        'id_subestacion',
        'id_perfil'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'contrasena'
    // ];

    /**
     * Send accessors
     *
     * @var array
     */
    protected $appends = [
        'nombre_completo'
    ];

    /**
     * Obtiene el nombre completo del usuario
     *
     * @return string
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->app} {$this->apm}";
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'id', 'id_perfil');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permisos()
    {
        return $this->belongsToMany(
            Permiso::class, // Modelo con el que se relaciona
            PermisoUsuarios::class, // Tabla pivote (Intermedia)
            'id_usuario', // Llave foránea de la tabla actual en la tabla pivote
            'id_permiso' // Llave foránea del modelo con el que se relaciona en la tabla pivote
        );
    }

      /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function equipos()
    {
        return $this->belongsToMany(
            Equipo::class, // Modelo con el que se relaciona
            UsuarioEquipo::class, // Tabla pivote (Intermedia)
            'id_usuario', // Llave foránea de la tabla actual en la tabla pivote
            'id_equipo' // Llave foránea del modelo con el que se relaciona en la tabla pivote
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inspecciones()
    {
        return $this->belongsToMany(
            GestionInspeccion::class, // Modelo con el que se relaciona
            ControlInspeccion::class, // Tabla pivote (Intermedia)
            'id_usuario', // Llave foránea de la tabla actual en la tabla pivote
            'id_gestion_inspeccion' // Llave foránea del modelo con el que se relaciona en la tabla pivote
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function detalleEstatus()
    {
        return $this->belongsTo(DetalleEstatus::class,'id_usuario', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function usuariosEquipo()
    {
        return $this->belongsTo(UsuarioEquipo::class,'id_usuario', 'id');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function estaciones()
    {
        return $this->hasMany(Estacion::class, 'id', 'id_perfil');
    }

      /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function subestaciones()
    {
        return $this->hasMany(Subestacion::class, 'id', 'id_perfil');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function verificacionCorreo()
    {
        return $this->hasOne(VerificacionCorreo::class, 'id_usuario', 'id');
    }

}

