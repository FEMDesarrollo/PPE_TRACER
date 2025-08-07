<?php
// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// 1. CAMBIO: Importa tu modelo 'Usuarios'
use App\Models\Usuarios; 

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate para Superadmin (Rol 1)
        // 2. CAMBIO: Usa 'Usuarios' como el tipo de la variable $user
        Gate::define('is-superadmin', function (Usuarios $user) {
            return $user->rol_id == 1;
        });

        // Gate para Admin y Superadmin (Roles 1 y 2)
        // 3. CAMBIO: Usa 'Usuarios' como el tipo de la variable $user
        Gate::define('is-admin', function (Usuarios $user) {
            return in_array($user->rol_id, [1, 2]);
        });
    }
}