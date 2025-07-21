<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaUsuarios implements WithHeadings
{
    public function headings(): array
    {
        return [
        'nombre',
        'app',
        'apm',
        'telefono',
        'correo',
        'password',
        'foto',
        'id_estacion',
        'id_subestacion',
        'id_perfil',
        ];
    }
}
