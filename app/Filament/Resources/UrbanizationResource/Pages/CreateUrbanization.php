<?php

namespace App\Filament\Resources\UrbanizationResource\Pages;

use App\Filament\Resources\UrbanizationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUrbanization extends CreateRecord
{
    protected static string $resource = UrbanizationResource::class;

    protected function getRedirectUrl(): string
    {
      return $this->getResource()::getUrl('index');
    }
}
