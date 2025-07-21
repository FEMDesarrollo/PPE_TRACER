<?php

namespace App\Imports;

use App\Models\Perfiles;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PerfilesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Perfiles([
            'nombre'        => $row['nombre'],
        ]);
    }
     public function rules(): array
    {
        return Perfiles::validationRules();
    }

    public function customValidationMessages()
    {
        return Perfiles::validationMessages();
    }
}
