<?php

namespace App\Filament\Resources\ComercialClientResource\Pages;

use App\Filament\Resources\ComercialClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComercialClient extends EditRecord
{
    protected static string $resource = ComercialClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
