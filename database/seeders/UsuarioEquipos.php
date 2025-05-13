<?php

namespace Database\Seeders;

use App\Models\UsuarioEquipo;
use Illuminate\Database\Seeder;

class UsuarioEquipos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsuarioEquipo::truncate();

       $fechaActual = now()->toDateTimeString();

       UsuarioEquipo::insert([
        [
            'id'                    => 1,
            'fecha_estatus'         => $fechaActual,
            'comentarios'           => 'comentarios x',
            'id_estatus_equipo'     => 2,      
            'id_usuario'            => 1,
            'id_equipo'             => 4,
            'created_at'            => $fechaActual,
            'updated_at'            => $fechaActual
        ],
        [
            'id'                    => 2,
            'fecha_estatus'         => $fechaActual,
            'comentarios'           => 'comentarios x',
            'id_estatus_equipo'     => 2,      
            'id_usuario'            => 2,
            'id_equipo'             => 1,
            'created_at'            => $fechaActual,
            'updated_at'            => $fechaActual
        ],
        [
            'id'                    => 3,
            'fecha_estatus'         => $fechaActual,
            'comentarios'           => 'comentarios x',
            'id_estatus_equipo'     => 2,
            'id_usuario'            => 1,
            'id_equipo'             => 2,
            'created_at'            => $fechaActual,
            'updated_at'            => $fechaActual
        ],
    ]);
    }
}
