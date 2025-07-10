<?php

namespace App\Imports;

use App\Models\Estaciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EstacionesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Estaciones([
            'nombre'        => $row['nombre'],
            'direccion'     => $row['direccion'],
            'telefono'      => $row['telefono'],
            'total_trajes'  => $row['total_trajes'],
        ]);
    }
}
