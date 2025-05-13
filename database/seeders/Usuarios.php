<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::truncate();

        $fechaActual = now()->toDateTimeString();

        Usuario::insert([
            [
                'id'                        => 1,
                'nombre'                    => 'Juan',
                'app'                       => 'Valle',
                'apm'                       => 'Gonzalez',
                'telefono'                  => '7536985214',
                'correo'                    => 'juan@gmail.com',
                'password'                  => Hash::make('md5'),
                'id_estacion'               => 1,
                'id_subestacion'            => 1,
                'id_perfil'                 => 1,
                'created_at'                => $fechaActual,
                'updated_at'                => $fechaActual,
            ],
            [
                'id'                        => 2,
                'nombre'                    => 'Oscar',
                'app'                       => 'Ramirez',
                'apm'                       => 'Gonzalez',
                'telefono'                  => '7589630259',
                'correo'                    => 'oscar@gmail.com',
                'password'                  => Hash::make('md5'),
                'id_estacion'               => 2,
                'id_subestacion'            => 1,
                'id_perfil'                 => 1,
                'created_at'                => $fechaActual,
                'updated_at'                => $fechaActual,
            ],
        ]);
    }
}
