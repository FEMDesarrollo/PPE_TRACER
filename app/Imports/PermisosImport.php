<?php

namespace App\Imports;

use App\Models\permisos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PermisosImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new permisos([

            'permiso'        => $row['permiso'],
            'icono'        => $row['icono'],
            'url'        => $row['url'],

        ]);
    }

     public function rules(): array
    {
        return permisos::validationRules();
    }

    public function customValidationMessages()
    {
        return permisos::validationMessages();
    }
}
