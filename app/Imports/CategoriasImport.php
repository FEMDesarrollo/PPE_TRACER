<?php

namespace App\Imports;

use App\Models\Categorias;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class CategoriasImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Categorias([
            'categoria'        => $row['categoria'],
            'id_equipo'        => $row['id_equipo'],
        ]);
    }

    public function rules(): array
    {
        return Categorias::validationRules();
    }

    public function customValidationMessages()
    {
        return Categorias::validationMessages();
    }
}
