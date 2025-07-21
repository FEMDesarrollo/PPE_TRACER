<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaControlAsignaciones implements WithHeadings
{
    public function headings(): array
    {
        return [
        'observaciones',
        'fecha_asignacion',
        'fecha_devolucion',
        'id_usuario_equipo',
        'id_estatus_critico',
        ];
    }
}

