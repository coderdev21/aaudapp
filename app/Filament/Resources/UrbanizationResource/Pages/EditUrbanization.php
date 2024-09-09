<?php

namespace App\Filament\Resources\UrbanizationResource\Pages;

use App\Filament\Resources\UrbanizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUrbanization extends EditRecord
{
    protected static string $resource = UrbanizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
