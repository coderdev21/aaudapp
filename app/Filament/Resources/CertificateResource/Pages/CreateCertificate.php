<?php

namespace App\Filament\Resources\CertificateResource\Pages;

use App\Filament\Resources\CertificateResource;
use App\Models\Customer;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateCertificate extends CreateRecord
{
  protected static string $resource = CertificateResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    //Busca en la tabla 'certificates' el ultimo id y le suma uno mas
    //para agregarlo al 'control_number'
    $lastRecordId = DB::table('certificates')->max('id');
    $nextId = $lastRecordId ? $lastRecordId + 1 : 1;
    $currentYear = Carbon::now()->year;
    $data['control_number'] = 'CT-' . $nextId . '-' . $currentYear;

    //Agrega la fecha de hoy y le suma 30 días
    $data['expiration_date'] = Carbon::now()->addDays(30);

    return $data;
  }
}
