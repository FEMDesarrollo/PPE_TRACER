<?php

namespace App\Providers;

use App\Models\Equipo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Permiso;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->runningInConsole() && Schema::hasTable('permisos')) {
            View::share('Permisos', Permiso::query()
                ->whereNull('parent_id')
                ->with('submenus')
                ->get());
        }
        if (Schema::hasTable('equipos')) {
            $equipos = Equipo::all();
            View::share('equipos', $equipos);
        }
    }
}
