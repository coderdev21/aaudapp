<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\ForceRenewPassword;
use App\Models\Employee;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EditUser extends EditRecord
{
  protected static string $resource = UserResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }

  protected function getHeaderActions(): array
  {
    return [
      Actions\DeleteAction::make(),
    ];
  }

  protected string $password;

  protected function mutateFormDataBeforeSave(array $data): array
  {
    if (!! $data['force_renew_password']) {
      //Para usar RenewPassword Plugin
      $this->password = Str::password(12); // genero una contraseña de 12 caracteres
      $data['password'] = bcrypt($this->password);

      $nombre = Employee::where('id', $data['employee_id'])
        ->first();
      $dataToSend = array(
        'employee_id' => $data['employee_id'],
        'name' => $data['name'],
        'email' => $data['email'],
        'nombre' => $nombre['nombre'],
        'password' => $this->password
      );
      Mail::to($data['email'])->send(new ForceRenewPassword($dataToSend));
      return $data;
    } else {
      return $data;
    }
  }
}
