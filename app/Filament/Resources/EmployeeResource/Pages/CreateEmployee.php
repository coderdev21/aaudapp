<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
  protected static string $resource = EmployeeResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }

  protected function mutateFormDataBeforeCreate(array $data): array
  {

    //Convierte los nombres en mayuscula
    $data['nombre'] = strtoupper($data['nombre']);
    $data['segundo_nombre'] = strtoupper($data['segundo_nombre']);
    $data['apellido_paterno'] = strtoupper($data['apellido_paterno']);
    $data['apellido_materno'] = strtoupper($data['apellido_materno']);
    return $data;

  }
}
