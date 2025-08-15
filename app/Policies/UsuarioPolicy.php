<?php

namespace App\Policies;

use App\Models\Usuarios;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuarioPolicy
{
    use HandlesAuthorization;

    /**
     * Permite que un Superadmin (perfil 1) realice cualquier acción sin restricciones.
     * Este método se ejecuta antes que cualquier otra regla en la policy.
     */
    public function before(Usuarios $user, string $ability): bool|null
    {
        if ($user->id_perfil == 1) {
            return true; // Si es Superadmin, concede permiso para todo.
        }
        return null; // Si no, devuelve null para que Laravel continúe con la regla específica.
    }

    /**
     * Determina si el usuario ($user) puede actualizar al modelo ($usuario_a_editar).
     *
     * Se invoca con: $this->authorize('update', $usuario_a_editar);
     */
public function update(Usuarios $user, Usuarios $usuario_a_editar): bool
{
    // REGLA PRINCIPAL: Un usuario siempre puede editar su propio perfil.
    if ($user->id === $usuario_a_editar->id) {
        return true;
    }

    // La regla 'before' ya permite al Superadmin (rol 1) editar a cualquiera.
    // Las siguientes reglas son para cuando un usuario intenta editar a OTRO usuario.

    // REGLA 1: Nadie puede editar a un Superadmin (excepto otro Superadmin, ya cubierto).
    if ($usuario_a_editar->id_perfil == 1) {
        return false;
    }

    // REGLA 2: Un Admin (rol 2) puede editar a perfiles inferiores a él.
    if ($user->id_perfil == 2) {
        return $usuario_a_editar->id_perfil > 2;
    }

    // Por defecto, si no cumple ninguna de las condiciones anteriores, no puede editar a otros.
    return false;
}

    /**
     * Determina si el usuario ($user) puede eliminar al modelo ($usuario_a_eliminar).
     *
     * Se invoca con: $this->authorize('delete', $usuario_a_eliminar);
     */
    public function delete(Usuarios $user, Usuarios $usuario_a_eliminar): bool
    {
        // La regla 'before' ya permite al Superadmin (rol 1) hacer todo.

        // REGLA 1: Un usuario no se puede eliminar a sí mismo.
        if ($user->id === $usuario_a_eliminar->id) {
            return false;
        }

        // REGLA 2: Nadie puede eliminar a un Superadmin (excepto otro Superadmin, cubierto por 'before').
        if ($usuario_a_eliminar->id_perfil == 1) {
            return false;
        }

        // REGLA 3: Un Admin (rol 2) solo puede eliminar perfiles inferiores a él.
        if ($user->id_perfil == 2) {
            return $usuario_a_eliminar->id_perfil > 2;
        }

        // Por defecto, si no es Superadmin o Admin con permiso, se deniega.
        return false;
    }
}