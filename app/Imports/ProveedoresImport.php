<?php

namespace App\Imports;

use App\Models\Proveedores;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProveedoresImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Proveedores([
            'nombre'        => $row['nombre'],
            'direccion'        => $row['direccion'],
            'telefono'        => $row['telefono'],

        ]);
    }
}
