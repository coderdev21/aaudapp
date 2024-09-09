<?php

namespace App\Filament\Resources\CustomerOmissionResource\Pages;

use App\Filament\Resources\CustomerOmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerOmissions extends ListRecords
{
    protected static string $resource = CustomerOmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
