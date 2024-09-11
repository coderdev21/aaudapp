<?php

namespace App\Filament\Resources\CorrespondenceResource\Pages;

use App\Filament\Resources\CorrespondenceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCorrespondence extends CreateRecord
{
    protected static string $resource = CorrespondenceResource::class;

    protected function getRedirectUrl(): string
    {
      return $this->getResource()::getUrl('index');
    }
}
