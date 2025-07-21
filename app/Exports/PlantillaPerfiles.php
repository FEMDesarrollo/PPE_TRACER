<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaPerfiles implements WithHeadings
{
    public function headings(): array
    {
        return [
        'nombre'
        ];
    }
}

