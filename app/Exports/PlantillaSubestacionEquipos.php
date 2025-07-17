<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaSubestacionEquipos implements WithHeadings
{
    public function headings(): array
    {
        return [
        'no_traje',
        'id_equipo',
        'id_estacion',
        'id_subestacion'
        ];
    }
}
