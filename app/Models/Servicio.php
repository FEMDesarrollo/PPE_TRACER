<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicio extends Model
{
    use HasFactory, WithCustomScopes, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servicio';

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
        'servicio'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function proveedores()
    {
        return $this->belongsToMany(
            Proveedor::class, // Modelo con el que se relaciona
            ProveedorServicio::class, // Tabla pivote (Intermedia)
            'id_servicio', // Llave foránea de la tabla actual en la tabla pivote
            'id_proveedor' // Llave foránea del modelo con el que se relaciona en la tabla pivote
        );
    }
}
