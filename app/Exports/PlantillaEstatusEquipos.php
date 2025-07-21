<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaEstatusEquipos implements WithHeadings
{
    public function headings(): array
    {
        return [
        'estado'
        ];
    }
}

