<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaDetallesEquipo implements WithHeadings
{
    public function headings(): array
    {
        return [
        'modelo',
        'no_serie',
        'talla',
        'piezas',
        'fecha_fabricacion',
        'id_usuario_equipo',
        ];
    }
}

