<?php

namespace App\Imports;

use App\Models\subestacionEquipos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubestacionEquiposImport implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row)
    {
        return new subestacionEquipos([
            'no_traje' => $row['no_traje'],
            'id_equipo' => $row['id_equipo'],
            'id_estacion' => $row['id_estacion'],
            'id_subestacion' => $row['id_subestacion']
        ]);
    }
    public function rules(): array
    {
        return subestacionEquipos::validationRules();
    }

    public function customValidationMessages()
    {
        return subestacionEquipos::validationMessages();
    }
}
