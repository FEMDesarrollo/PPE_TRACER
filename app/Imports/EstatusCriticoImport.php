<?php

namespace App\Imports;

use App\Models\EstatusCritico;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EstatusCriticoImport implements ToModel, WithHeadingRow, WithValidation
{
     public function model(array $row)
    {
        return new EstatusCritico([
            'estatus'        => $row['estatus'],
        ]);
    }
             public function rules(): array
    {
        return EstatusCritico::validationRules();
    }

    public function customValidationMessages()
    {
        return EstatusCritico::validationMessages();
    }
}
