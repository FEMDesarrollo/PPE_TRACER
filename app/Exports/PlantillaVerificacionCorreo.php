<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaVerificacionCorreo implements WithHeadings
{
    public function headings(): array
    {
        return [
        'codigo_verificacion',
        'fecha',
        'id_usuario',
        ];
    }
}
