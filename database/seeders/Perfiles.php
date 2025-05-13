<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class Perfiles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::truncate();

        $fechaActual = now()->toDateTimeString();

        Perfil::insert([
            [
                'id'                => 1,
                'nombre'            => 'Administrador',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 2,
                'nombre'            => 'Bombero',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],

        ]);
    }
}
