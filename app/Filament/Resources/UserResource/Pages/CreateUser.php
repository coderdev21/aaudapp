<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\UserCreate;
use App\Models\Employee;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
  protected static string $resource = UserResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }

  protected string $password;

  protected function mutateFormDataBeforeCreate(array $data): array
  {

    //Para usar RenewPassword Plugin
    $this->password = Str::password(12); // genero el una contraseña de 12 caracteres
    $data['password'] = bcrypt($this->password);
    $data['force_renew_password'] = true; // fuerzo a usuario a cambiar la contraseña en el primer login
    
    $nombre = Employee::where('id', $data['employee_id'])
      ->first();
    $dataToSend = array(
      'employee_id' => $data['employee_id'],
      'name' => $data['name'],
      'email' => $data['email'],
      'nombre' => $nombre['nombre'],
      'password' => $this->password
    );
    Mail::to($data['email'])->send(new UserCreate($dataToSend));

    return $data;
  }

  protected function afterCreate(): void
  {

    $newuser = $this->record;
    
    $user = User::where('id', $newuser->id)->first();
    //dd($user);

       Notification::make()
      ->success()
      ->title('Bienvenido al Sistema de Gestion Administrativa de la AAUD')
      ->sendToDatabase($user);
  }
}
