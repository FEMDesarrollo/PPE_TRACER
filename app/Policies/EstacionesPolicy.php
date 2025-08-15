<?php

namespace App\Policies;

use App\Models\Estaciones; 
use App\Models\Usuarios;
use Illuminate\Auth\Access\Response;

class EstacionesPolicy
{
    /**
     * Determina si el usuario puede editar la estación.
     */
    public function update(Usuarios $usuarios, Estaciones $estaciones): bool 
    {
        // Solo Superadmins (rol 1) y Admins (rol 2) pueden editar.
        return $usuarios->id_perfil == 1 || $usuarios->id_perfil == 2;
    }

    /**
     * Determina si el usuario puede eliminar la estación.
     */
    public function delete(Usuarios $usuarios, Estaciones $estaciones): bool 
    {
        // SOLO el Superadmin (rol 1) y Admins (rol 2) pueden eliminar estaciones.
        return $usuarios->id_perfil == 1 || $usuarios->id_perfil == 2;
    }
}