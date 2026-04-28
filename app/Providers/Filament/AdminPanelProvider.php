<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path(env('FILAMENT_PATH', 'admin'))
            ->login(Login::class)
            ->brandName(env('FILAMENT_BRAND_NAME', 'Protiddhoni Studio'))
            ->brandLogo(fn (): HtmlString => new HtmlString('<img src="'.asset('assets/img/protiddhoni-logo.png').'" alt="Protiddhoni" class="vr-filament-brand-logo">'))
            ->brandLogoHeight('2.65rem')
            ->favicon(asset('favicon.svg'))
            ->colors([
                'primary' => Color::hex('#003087'),  // navy
                'gray'    => Color::Slate,
                'warning' => Color::hex('#FFC439'),  // gold
                'success' => Color::Emerald,
                'info'    => Color::hex('#0070BA'),  // blue
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): HtmlString => new HtmlString('<link rel="stylesheet" href="'.asset('assets/admin/protiddhoni-admin.css').'">'),
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn (): string => Blade::render('@include("filament.hooks.login-before")'),
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn (): string => Blade::render('@include("filament.hooks.login-after")'),
            )
            ->renderHook(
                PanelsRenderHook::CONTENT_BEFORE,
                fn (): string => Blade::render('@include("filament.hooks.content-before")'),
            )
            ->authGuard('admin')
            ->discoverResources(in: app_path('Filament/Resources'),  for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'),         for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'),     for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
