<?php

namespace Database\Seeders;

use App\Models\GestionInspeccion;
use Illuminate\Database\Seeder;

class GestionInspecciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GestionInspeccion::truncate();

        $fechaActual = now()->toDateTimeString();

        GestionInspeccion::insert([
            [
                'id'                => 1,
                'observaciones'     => 'Sedimientos',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 2,
                'observaciones'     => 'Contaminación',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 3,
                'observaciones'     => 'Daños Físicos',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 4,
                'observaciones'     => 'Daño o falta de cinta Reflectante',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 5,
                'observaciones'     => 'Perdida de integridad de Costura',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 6,
                'observaciones'     => 'Tamaño correcto y Ensamblaje',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 7,
                'observaciones'     => 'Instalación en la prenda',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 8,
                'observaciones'     => 'Pérdida de integridad de Costura',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 9,
                'observaciones'     => 'Pérdida de Ajuste de la Abertura Facial',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 10,
                'observaciones'     => 'Daño a la Capa de Bloqueo de Partículas',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 11,
                'observaciones'     => 'Daños físicos al Casco',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 12,
                'observaciones'     => 'Daños a las Solapas',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 13,
                'observaciones'     => 'Componentes Dañados o Faltantes del sistema de Suspensión y Retención',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 14,
                'observaciones'     => 'Daño o falta de componentes del sistema de Visera/Gajas',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 15,
                'observaciones'     => 'Encogimiento',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 16,
                'observaciones'     => 'Pérdida de elasticidad o Flexibilidad',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 17,
                'observaciones'     => 'Pérdida de resistencia al agua',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
            [
                'id'                => 18,
                'observaciones'     => 'Daño y funcionalidad de Costura',
                'created_at'        => $fechaActual,
                'updated_at'        => $fechaActual
            ],
           

        ]);
    }
}
