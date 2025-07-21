<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaCategorias implements WithHeadings
{
    public function headings(): array
    {
        return [
        'categoria',
        'id_equipo'
        ];
    }
}

