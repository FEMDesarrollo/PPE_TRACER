<?php

namespace App\Imports;

use App\Models\Estaciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EstacionesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Estaciones([
            'nombre'        => $row['nombre'],
            'direccion'     => $row['direccion'],
            'telefono'      => $row['telefono'],
            'total_trajes'  => $row['total_trajes'],
        ]);
    }
         public function rules(): array
    {
        return Estaciones::validationRules();
    }

    public function customValidationMessages()
    {
        return Estaciones::validationMessages();
    }
}

