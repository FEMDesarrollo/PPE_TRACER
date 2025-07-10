<?php

namespace App\Imports;

use App\Models\Equipos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EquiposImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Equipos([
            'equipo'        => $row['equipo'],
        ]);
    }

     public function rules(): array
    {
        return Equipos::validationRules();
    }

    public function customValidationMessages()
    {
        return Equipos::validationMessages();
    }
}
