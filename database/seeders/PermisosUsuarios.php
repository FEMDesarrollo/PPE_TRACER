<?php

namespace Database\Seeders;

use App\Models\PermisoUsuarios;
use Illuminate\Database\Seeder;

class PermisosUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermisoUsuarios::truncate();

        PermisoUsuarios::insert([
            [
                'id_usuario'           => 1,
                'id_permiso'           => 1,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 2,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 3,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 4,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 5,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 6,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 7,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 8,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 9,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 10,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 11,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 12,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 13,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 14,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 15,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 16,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 17,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 18,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 19,
                'activo'               => true
            ],
            [
                'id_usuario'           => 1,
                'id_permiso'           => 20,
                'activo'               => true
            ],
           

        ]);
    }
}
