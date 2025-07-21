<?php

namespace App\Imports;

use App\Models\EstatusEquipos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EstatusEquiposImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new EstatusEquipos([
            'estado'        => $row['estado'],
        ]);
    }
         public function rules(): array
    {
        return EstatusEquipos::validationRules();
    }

    public function customValidationMessages()
    {
        return EstatusEquipos::validationMessages();
    }
}
