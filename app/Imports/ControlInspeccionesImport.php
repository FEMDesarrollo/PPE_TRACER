<?php

namespace App\Imports;

use App\Models\ControlInspecciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ControlInspeccionesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ControlInspecciones([
            'respuestas'        => $row['servicio'],
            'fecha'        => $row['servicio'],
            'imagen'        => $row['servicio'],
            'descripcion'        => $row['servicio'],
            'id_usuario'        => $row['servicio'],
            'id_gestion_inspeccion'        => $row['servicio'],
        ]);
    }
}
