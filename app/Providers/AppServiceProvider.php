<?php

namespace App\Providers;

use App\Models\Notificacion;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;

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
    public function boot(): void
{
     View::composer('*', function ($view) {
        $notificaciones = Auth::check()
            ? Notificacion::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get()
            : collect();

        $view->with('notificaciones', $notificaciones);
    });
}
}
