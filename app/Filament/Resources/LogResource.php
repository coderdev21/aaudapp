<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Form;
use Rmsramos\Activitylog\Resources\ActivitylogResource;

class LogResource extends ActivitylogResource implements HasShieldPermissions
{

  public static function getPermissionPrefixes(): array
  {
    return [
      'view',
      'view_any',
    ];
  }

  public static function getPages(): array
  {
    return [
      'view' => Pages\ViewLog::route('/{record}'),
      'index' => Pages\ListLogs::route('/'),
    ];
  }
}
