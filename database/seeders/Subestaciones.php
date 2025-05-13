<?php

namespace Database\Seeders;

use App\Models\Subestacion;
use Illuminate\Database\Seeder;

class Subestaciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subestacion::truncate();

        $fechaActual = now()->toDateTimeString();

        Subestacion::insert([
            [
                'id'                    => 1,
                'nombre'                => 'sin subestacion',
                'direccion'             => 'sin direccion',
                'telefono'              => 'sin telefono',
                'id_estacion'           => 1,
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 2,
                'nombre'                => 'Prueba Subestacion',
                'direccion'             => 'Prueba Subestacion',
                'telefono'              => 'Prueba Subestacion',
                'id_estacion'           => 1,
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],

        ]);
    }
}
