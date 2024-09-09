<?php

namespace App\Filament\Resources\CustomerOmissionResource\Pages;

use App\Filament\Resources\CustomerOmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerOmission extends EditRecord
{
    protected static string $resource = CustomerOmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
