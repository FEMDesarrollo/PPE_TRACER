<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaEstaciones implements WithHeadings
{
    public function headings(): array
    {
        return [
            'nombre',
            'direccion',
            'telefono',
            'total_trajes',
        ];
    }
}

