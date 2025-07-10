<?php

namespace App\Imports;

use App\Models\EstatusEquipos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EstatusEquiposImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new EstatusEquipos([
            'estado'        => $row['estado'],
        ]);
    }
}
