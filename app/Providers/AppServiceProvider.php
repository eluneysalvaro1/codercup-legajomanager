<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // There is no public registration/generic login route (see project brief), so
        // plain "auth" middleware (e.g. the /descargas/* routes) needs to be told where
        // to send unauthenticated users, otherwise it fails resolving the "login" route.
        Authenticate::redirectUsing(fn (Request $request) => $request->is('admin*')
            ? route('filament.admin.auth.login')
            : route('filament.panel.auth.login'));
    }
}
