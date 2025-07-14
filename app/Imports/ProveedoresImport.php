<?php

namespace App\Imports;

use App\Models\Proveedores;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class ProveedoresImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Proveedores([
            'nombre'        => $row['nombre'],
            'direccion'        => $row['direccion'],
            'telefono'        => $row['telefono'],

        ]);
    }
    
    public function rules(): array
    {
        return Proveedores::validationRules();
    }

    public function customValidationMessages()
    {
        return Proveedores::validationMessages();
    }
}
