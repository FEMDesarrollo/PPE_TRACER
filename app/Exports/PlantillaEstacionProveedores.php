<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaEstacionProveedores implements WithHeadings
{
    public function headings(): array
    {
        return [
        'id_proveedor',
        'id_estacion',
        ];
    }
}

