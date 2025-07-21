<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaEquipos implements WithHeadings
{
    public function headings(): array
    {
        return [
        'equipo'   
        ];
    }
}

