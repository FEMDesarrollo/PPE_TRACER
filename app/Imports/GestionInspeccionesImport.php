<?php

namespace App\Imports;

use App\Models\GestionInspecciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GestionInspeccionesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new GestionInspecciones([
            'observaciones'        => $row['observaciones'],
        ]);
    }
}
