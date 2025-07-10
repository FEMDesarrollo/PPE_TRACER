<?php

namespace App\Imports;

use App\Models\usuarios;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsuariosImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Usuarios([
            'nombre'        => $row['nombre'],
            'app'        => $row['app'],
            'apm'     => $row['apm'],
            'telefono'      => $row['telefono'],
            'correo'  => $row['correo'],
            'password'  => $row['password'],
            'foto'  => $row['foto'],
            'id_estacion'  => $row['id_estacion'],
            'id_subestacion'  => $row['id_subestacion'],
            'id_perfil'  => $row['id_perfil'],
            
        ]);
    }
}
