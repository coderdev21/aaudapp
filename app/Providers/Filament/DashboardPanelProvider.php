<?php

namespace App\Providers\Filament;

use App\Filament\Auth\CustomLogin;
use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Resources\LogResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\LegacyComponents\Widget;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Filament\Widgets\View\WidgetsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Auth;
use Rmsramos\Activitylog\ActivitylogPlugin;
use Sabberworm\CSS\Settings;
use Yebor974\Filament\RenewPassword\RenewPasswordPlugin;

class DashboardPanelProvider extends PanelProvider
{
  public function panel(Panel $panel): Panel
  {
    return $panel
      ->default()
      ->id('dashboard')
      ->databaseNotifications()
      ->path('/')
      ->favicon(asset('images/logoaaud.png'))
      ->login(CustomLogin::class)
      ->profile(EditProfile::class)
      ->brandName('Autoridad de Aseo Urbano y Domiciliario')
      ->brandLogo(asset('images/logogobiernoaaud.png'))
      ->darkModeBrandLogo(asset('images/logogobiernoaaud_darkmode.png'))
      ->brandLogoHeight(fn() => Auth::check() ? '4rem' : '8rem')
      ->colors([
        'danger' => Color::hex('#ff6666'),
        'gray' => Color::hex('#595959'),
        'info' => Color::hex('#1ca1e6'),
        'primary' => Color::hex('#1ca1e6'),
        'success' => Color::hex('#15a04f'),
        'warning' => Color::hex('#ffcc66'),
      ])
      ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
      ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
      ->pages([
        Pages\Dashboard::class,
      ])
      ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
      ->widgets([
        Widgets\StatsOverviewWidget::class
        //Widgets\AccountWidget::class,
        //Widgets\FilamentInfoWidget::class,
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
      ])
      ->plugins([
        \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
        (new RenewPasswordPlugin())
          ->forceRenewPassword(),
        ActivitylogPlugin::make()
          ->resource(LogResource::class)
          ->label('Log de Auditoria')
          ->pluralLabel('Logs de Auditoria')
          ->navigationGroup('Auditoria del Sistema')
          ->navigationIcon('fas-magnifying-glass-chart'),
      ])
      ->userMenuItems([
        MenuItem::make()
          ->label('Cambiar Contraseña')
          ->url('#')
          ->icon('fas-key'),
      ]);
  }
}
