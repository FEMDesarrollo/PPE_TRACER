<?php

namespace App\Imports;

use App\Models\ProveedorServicio;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProveedorServicioImport implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row)
    {
        return new ProveedorServicio([
            'id_servicio'  => $row['id_servicio'],
            'id_proveedor'  => $row['id_proveedor'],
        ]);
    }

    public function rules(): array
    {
        return ProveedorServicio::validationRules();
    }

    public function customValidationMessages()
    {
        return ProveedorServicio::validationMessages();
    }
}
