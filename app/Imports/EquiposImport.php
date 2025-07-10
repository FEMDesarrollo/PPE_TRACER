<?php

namespace App\Imports;

use App\Models\Equipos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EquiposImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Equipos([
            'equipo'        => $row['equipo'],
        ]);
    }
}
