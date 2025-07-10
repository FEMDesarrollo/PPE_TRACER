<?php

namespace App\Imports;

use App\Models\Subestacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubestacionImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Subestacion([
            'nombre'        => $row['nombre'],
            'direccion'     => $row['direccion'],
            'telefono'      => $row['telefono'],
            'id_estacion'  => $row['id_estacion'],
            
        ]);
    }
}
