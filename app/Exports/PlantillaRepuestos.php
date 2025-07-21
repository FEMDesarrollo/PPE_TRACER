<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaRepuestos implements WithHeadings
{
    public function headings(): array
    {
        return [
        'costo',
        'fecha_disponible',
        'id_prov_servicio',
        'id_accesorio'
        ];
    }
}

