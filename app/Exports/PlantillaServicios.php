<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaServicios implements WithHeadings
{
    public function headings(): array
    {
        return [
        'servicio'
        ];
    }
}

