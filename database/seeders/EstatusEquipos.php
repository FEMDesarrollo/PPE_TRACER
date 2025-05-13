<?php

namespace Database\Seeders;

use App\Models\EstatusEquipo;
use Illuminate\Database\Seeder;

class EstatusEquipos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstatusEquipo::truncate();

        $fechaActual = now()->toDateTimeString();

        EstatusEquipo::insert([
            [
                'id'                    => 1,
                'estado'                => 'Mantenimiento',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 2,
                'estado'                => 'Disponible',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 3,
                'estado'                => 'Asignado',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 4,
                'estado'                => 'Fuera de Servicio',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],

        ]);
    }
}
