<?php

namespace Database\Seeders;

use App\Models\Accesorio;
use Illuminate\Database\Seeder;

class Accesorios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Accesorio::truncate();

       $fechaActual = now()->toDateTimeString();

       Accesorio::insert([
        [
            'id'                    => 1,
            'nombre'                => 'Casco UST LW',
            'marca'                 => 'marca x',
            'modelo'                => 'modelo x',
            'detalle_descripcion'   => 'Certificación NFPA 1971',
            'id_equipo'             => 4,
            'created_at'            => $fechaActual,
            'updated_at'            => $fechaActual
        ],
        [
            'id'                    => 2,
            'nombre'                => 'Arnés ARAPAHO',
            'marca'                 => 'marca x',
            'modelo'                => 'modelo x',
            'detalle_descripcion'   => 'Certificación NFPA 1971',
            'id_equipo'             => 1,
            'created_at'            => $fechaActual,
            'updated_at'            => $fechaActual
        ],
        [
            'id'                    => 3,
            'nombre'                => 'Guantes 7886',
            'marca'                 => 'marca x',
            'modelo'                => 'modelo x',
            'detalle_descripcion'   => 'Certificación NFPA 1977',
            'id_equipo'             => 2,
            'created_at'            => $fechaActual,
            'updated_at'            => $fechaActual
        ],
    ]);
    }
}
