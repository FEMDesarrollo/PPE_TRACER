<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaControlInspecciones implements WithHeadings
{
    public function headings(): array
    {
        return [
        'respuestas',
        'fecha',
        'imagen',
        'descripcion',
        'id_usuario',
        'id_gestion_inspeccion',
        ];
    }
}

