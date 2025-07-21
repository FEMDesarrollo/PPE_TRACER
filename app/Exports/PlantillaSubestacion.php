<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaSubestacion implements WithHeadings
{
    public function headings(): array
    {
        return [
        'nombre',
        'direccion',
        'telefono',
        'id_estacion',
        ];
    }
}

