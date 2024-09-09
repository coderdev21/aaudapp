<?php

namespace App\Filament\Resources\UrbanizationResource\Pages;

use App\Filament\Resources\UrbanizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUrbanizations extends ListRecords
{
    protected static string $resource = UrbanizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
