<?php

namespace App\Policies;

use App\Models\Subestacion;
use App\Models\Usuarios;
use Illuminate\Auth\Access\Response;

class SubestacionPolicy
{
    /**
     * Determina si el usuario puede editar la subestación.
     */
    public function update(Usuarios $usuarios, Subestacion $subestacion): bool
    {
        // Solo Superadmins (rol 1) y Admins (rol 2) pueden editar.
        return $usuarios->id_perfil == 1 || $usuarios->id_perfil == 2;
    }

    /**
     * Determina si el usuario puede eliminar la subestación.
     */
    public function delete(Usuarios $usuarios, Subestacion $subestacion): bool
    {
        // SOLO el Superadmin (rol 1) y Admins (rol 2) pueden eliminar subestaciones.
        return $usuarios->id_perfil == 1 || $usuarios->id_perfil == 2;
    }
}