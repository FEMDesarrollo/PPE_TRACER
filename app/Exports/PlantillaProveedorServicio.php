<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaProveedorServicio implements WithHeadings
{
    public function headings(): array
    {
        return [
        'id_servicio',
        'id_proveedor'
        ];
    }
}

