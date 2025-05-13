<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Seeder;

class Equipos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipo::truncate();

        $fechaActual = now()->toDateTimeString();

        Equipo::insert([
            [
                'id'                    => 1,
                'equipo'                => 'Rescate',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 2,
                'equipo'                => 'Forestal',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 3,
                'equipo'                => 'Aproximacion',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 4,
                'equipo'                => 'Estructural',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],

        ]);
    }
}
