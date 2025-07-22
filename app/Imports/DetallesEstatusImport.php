<?php

namespace App\Imports;

use App\Models\detallesEstatus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DetallesEstatusImport implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row)
    {
        return new detallesEstatus([
            'total_respuesta'        => $row['total_respuesta'],
            'id_estatus'     => $row['id_estatus'],
            'id_usuario'      => $row['id_usuario'],

        ]);
    }

    public function rules(): array
    {
        return detallesEstatus::validationRules();
    }

    public function customValidationMessages()
    {
        return detallesEstatus::validationMessages();
    }
}
