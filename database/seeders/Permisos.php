<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Seeder;

class Permisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permiso::truncate();

        $fechaActual = now()->toDateTimeString();

        Permiso::insert([
            ['id' => 1, 'permiso' => 'Gestión de usuarios', 'icono' => 'bi bi-person-circle', 'parent_id' => null],
            ['id' => 2, 'permiso' => 'Gestión proveedores', 'icono' => 'bi bi-person-circle', 'parent_id' => null],
            ['id' => 3, 'permiso' => 'Gestión de equipos', 'icono' => 'bi bi-person-circle', 'parent_id' => null],
            ['id' => 4, 'permiso' => 'Infraestructura', 'icono' => 'bi bi-person-circle', 'parent_id' => null],

        ]);

        Permiso::insert([
            [
                'permiso'           => 'Responsable de equipo',
                'url'               => 'responsables',
                'parent_id'         => 1,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Usuarios',
                'url'               => 'usuarios',
                'parent_id'         => 1,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ]
        ]);

        Permiso::insert([
            [
                'permiso'           => 'Proveedores',
                'url'               => 'proveedores',
                'parent_id'         => 2,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Servicios',
                'url'               => 'servicios',
                'parent_id'         => 2,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Servicios de proveedores',
                'url'               => 'proveedoresServicios',
                'parent_id'         => 2,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
        ]);

        Permiso::insert([
            [
                'permiso'           => 'Accesorios',
                'url'               => 'accesorios',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Categorias',
                'url'               => 'categorias',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Detalles del equipo',
                'url'               => 'detallesEquipo',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Equipos',
                'url'               => 'equipos',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Equipos asignados',
                'url'               => 'controlAsignaciones',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Equipos de subestación',
                'url'               => 'subestacionEquipos',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Estado detallado',
                'url'               => 'detallesEstatus',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Repuestos',
                'url'               => 'repuestos',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Inspecciones de equipo',
                'url'               => 'inspecciones',
                'parent_id'         => 3,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
        ]);

        Permiso::insert([
            [
                'permiso'           => 'Estación',
                'url'               => 'estaciones',
                'parent_id'         => 4,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'permiso'           => 'Subestación',
                'url'               => 'subestaciones',
                'parent_id'         => 4,
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
        ]);

    }
}
