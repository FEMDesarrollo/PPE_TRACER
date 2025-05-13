<?php

namespace Database\Seeders;

use App\Models\Estacion;
use Illuminate\Database\Seeder;

class Estaciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estacion::truncate();

        $fechaActual = now()->toDateTimeString();

        Estacion::insert([
            [
                'id'                    => 1,
                'nombre'                => 'sin estacion',
                'direccion'             => 'sin direccion',
                'telefono'              => 'sin telefono',
                'total_trajes'          => 0,
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 2,
                'nombre'                => 'Estacion Prueba',
                'direccion'             => 'Estacion Prueba',
                'telefono'              => 'Estacion Prueba',
                'total_trajes'          => 0,
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],

        ]);
    }
}
