<?php

namespace App\Imports;

use App\Models\Perfiles;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerfilesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Perfiles([
            'nombre'        => $row['nombre'],
        ]);
    }
}
