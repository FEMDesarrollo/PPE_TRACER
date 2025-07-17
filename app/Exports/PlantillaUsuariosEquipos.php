<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaUsuariosEquipos implements WithHeadings
{
    public function headings(): array
    {
        return [
        'fecha_estatus',
        'comentarios',
        'id_estatus_equipo',
        'id_usuario',
        'id_equipo',
        ];
    }
}
