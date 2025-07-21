<?php

namespace App\Imports;

use App\Models\EstacionProveedores;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class EstacionProveedoresImport implements ToModel, WithHeadingRow, WithValidation
{
     public function model(array $row)
    {
        return new EstacionProveedores([
            'id_proveedor'        => $row['id_proveedor'],
            'id_estacion'        => $row['id_estacion'],
        ]);
    }

    public function rules(): array
    {
        return EstacionProveedores::validationRules();
    }

    public function customValidationMessages()
    {
        return EstacionProveedores::validationMessages();
    }
}
