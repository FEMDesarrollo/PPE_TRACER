<?php

namespace App\Imports;

use App\Models\gestionInspecciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GestionInspeccionesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new gestionInspecciones([
            'observaciones'        => $row['observaciones'],
        ]);
    }
    public function rules(): array
    {
        return gestionInspecciones::validationRules();
    }

    public function customValidationMessages()
    {
        return gestionInspecciones::validationMessages();
    }
}
