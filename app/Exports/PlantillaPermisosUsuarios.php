<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaPermisosUsuarios implements WithHeadings
{
    public function headings(): array
    {
        return [
        'id_usuario',
        'id_permiso',
        'activo'
        ];
    }
}

