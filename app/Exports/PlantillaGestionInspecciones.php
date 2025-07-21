<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaGestionInspecciones implements WithHeadings
{
    public function headings(): array
    {
        return [
        'observaciones'
        ];
    }
}

