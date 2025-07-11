<?php

namespace App\Imports;

use App\Models\Accesorios;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class AccesoriosImport implements ToModel, WithHeadingRow, WithValidation
{
   public function model(array $row)
    {
        return new Accesorios([
            'nombre'        => $row['nombre'],
            'imagen'        => $row['imagen'],
            'marca'        => $row['marca'],
            'modelo'        => $row['modelo'],
            'detalle_descripcion'        => $row['detalle_descripcion'],
            'id_equipo'        => $row['id_equipo'],
        ]);
    }

    public function rules(): array
    {
        return Accesorios::validationRules();
    }

    public function customValidationMessages()
    {
        return Accesorios::validationMessages();
    }
}
