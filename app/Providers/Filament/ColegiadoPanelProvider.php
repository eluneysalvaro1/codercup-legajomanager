<?php

namespace App\Providers\Filament;

use App\Filament\Colegiado\Pages\MiLegajo;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ColegiadoPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('panel')
            ->path('panel')
            ->login()
            ->brandName('CoderCup - Legajo Manager')
            ->viteTheme('resources/css/filament/panel/theme.css')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Colegiado/Resources'), for: 'App\Filament\Colegiado\Resources')
            ->discoverPages(in: app_path('Filament/Colegiado/Pages'), for: 'App\Filament\Colegiado\Pages')
            ->pages([
                MiLegajo::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Colegiado/Widgets'), for: 'App\Filament\Colegiado\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
