<?php

namespace App\Providers;

use App\Models\Estaciones;
use App\Models\usuarios;
use App\Models\Subestacion; 
use App\Policies\EstacionesPolicy;
use App\Policies\UsuarioPolicy; 
use App\Policies\SubestacionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Mapeamos los modelos a sus respectivas Policies.
        // Laravel las descubrirá automáticamente para acciones como update, delete, etc.
        Usuarios::class => UsuarioPolicy::class,
        Estaciones::class => EstacionesPolicy::class,
        Subestacion::class => SubestacionPolicy::class, 
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /*
        |--------------------------------------------------------------------------
        | GATES BASADOS EN ROL (Para comprobaciones generales)
        |--------------------------------------------------------------------------
        |
        | Estos son útiles para accesos generales que no dependen de un modelo específico.
        | Por ejemplo, mostrar un menú de administración.
        |
        | Uso en Blade: @can('is-superadmin') ... @endcan
        | Uso en Controlador: if (Gate::allows('is-admin')) { ... }
        |
        */
        Gate::define('is-superadmin', function (Usuarios $user) {
            // Asumo que el id_perfil 1 es Superadmin
            return $user->id_perfil == 1;
        });

        Gate::define('is-admin', function (Usuarios $user) {
            // Asumo que los perfiles 1 (Superadmin) y 2 (Admin) tienen acceso de administrador
            return in_array($user->id_perfil, [1, 2]);
        });

    }
}
