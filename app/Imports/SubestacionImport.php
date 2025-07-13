<?php

namespace App\Imports;

use App\Models\Subestacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubestacionImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Subestacion([
            'nombre'        => $row['nombre'],
            'direccion'     => $row['direccion'],
            'telefono'      => $row['telefono'],
            'id_estacion'  => $row['id_estacion'],
            
        ]);
    }

     public function rules(): array
    {
        return Subestacion::validationRules();
    }

    public function customValidationMessages()
    {
        return Subestacion::validationMessages();
    }
}
