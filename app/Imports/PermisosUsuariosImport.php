<?php

namespace App\Imports;

use App\Models\PermisosUsuarios;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PermisosUsuariosImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new PermisosUsuarios([
            'id_usuario'        => $row['id_usuario'],
            'id_permiso'        => $row['id_permiso'],
            'activo'        => $row['activo'],
        ]);
    }

    public function rules(): array
    {
        return PermisosUsuarios::validationRules();
    }

    public function customValidationMessages()
    {
        return PermisosUsuarios::validationMessages();
    }
}
