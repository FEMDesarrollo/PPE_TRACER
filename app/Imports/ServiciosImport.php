<?php

namespace App\Imports;

use App\Models\Servicios;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\WithValidation;

class ServiciosImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Servicios([
            'servicio'        => $row['servicio'],
        ]);
    }

    public function rules(): array
    {
        return Servicios::validationRules();
    }

    public function customValidationMessages()
    {
        return Servicios::validationMessages();
    }
}
