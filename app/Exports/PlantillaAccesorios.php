<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaAccesorios implements WithHeadings
{
    public function headings(): array
    {
        return [
        'nombre',
        'imagen',
        'marca',
        'modelo',
        'detalle_descripcion',
        'id_equipo'
        ];
    }
}

