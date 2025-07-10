<?php

namespace App\Imports;

use App\Models\Accesorios;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class AccesoriosImport implements ToModel, WithHeadingRow
{
   public function model(array $row)
    {
        return new Accesorios([
            'nombre'        => $row['nombre'],
            'imagen'        => $row['imagen'],
            'marca'        => $row['marca'],
            'modelo'        => $row['modelo'],
            'detalle_descripcion'        => $row['detalle_descripcion'],
            'id_equipo'        => $row['id_equipo'],
        ]);
    }
}
