<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaProveedores implements WithHeadings
{
    public function headings(): array
    {
        return [
        'nombre',
        'direccion',
        'telefono'
        ];
    }
}

