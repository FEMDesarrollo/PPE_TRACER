<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaDetallesEstatus implements WithHeadings
{
    public function headings(): array
    {
        return [
        'total_respuesta',
        'id_estatus',
        'id_usuario',
        ];
    }
}

