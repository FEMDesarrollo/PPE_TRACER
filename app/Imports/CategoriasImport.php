<?php

namespace App\Imports;

use App\Models\Categorias;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Categorias([
            'categoria'        => $row['categoria'],
            'id_equipo'        => $row['id_equipo'],
        ]);
    }
}
