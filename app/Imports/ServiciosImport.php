<?php

namespace App\Imports;

use App\Models\Servicios;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServiciosImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Servicios([
            'servicio'        => $row['servicio'],
        ]);
    }
}
