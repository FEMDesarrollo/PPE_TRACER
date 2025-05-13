<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\WithCustomScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repuesto extends Model
{
    use HasFactory, WithCustomScopes, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repuestos';

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
        'costo',
        'fecha_disponibilidad',
        'id_prov_servicio',
        'id_accesorio'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function provServicio()
    {
        return $this->hasMany(ProveedorServicio::class, 'id', 'id_prov_servicio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function accesorio()
    {
        return $this->hasMany(Accesorio::class, 'id', 'id_accesorio');
    }
}
