<?php

namespace App\Filament\Resources\CustomerTypeResource\Pages;

use App\Filament\Resources\CustomerTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerType extends CreateRecord
{
  protected static string $resource = CustomerTypeResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }

  protected function mutateFormDataBeforeCreate(array $data): array
  {

    //Convierte el tipo de usuario en mayuscula cerrada
    $data['name'] = strtoupper($data['name']);

    return $data;
  }
}
