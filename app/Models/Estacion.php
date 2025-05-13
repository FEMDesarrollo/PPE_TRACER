<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estacion extends Model
{
    use HasFactory, WithCustomScopes, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estaciones';

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
        'direccion',
        'telefono',
        'total_trajes'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function subestaciones()
    {
        return $this->hasMany(Subestacion::class, 'id_estacion', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function proveedor()
    {
        return $this->belongsToMany(
            Proveedor::class, // Modelo con el que se relaciona
            EstacionProveedor::class, // Tabla pivote (Intermedia)
            'id_estacion', // Llave foránea de la tabla actual en la tabla pivote
            'id_proveedor' // Llave foránea del modelo con el que se relaciona en la tabla pivote
        );
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_estacion');
    }
}

class Estacion extends Model
{
    protected $table = 'estacion'; // Especificar si no sigue el estándar plural
    protected $fillable = ['nombre', 'direccion', 'telefono','total_trajes']; // campos editables
}
