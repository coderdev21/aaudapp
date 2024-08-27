<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{

  public function getView(): string
  {
    return static::$view ?? 'filament.pages.auth.edit-profile';
  }

  public function getLayout(): string
  {
    return static::$layout ?? 'filament-panels::components.layout.index';
  }

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Cambiar Contraseña')
          ->description('Ingrese su nueva contraseña')
          ->schema([
            /*         $this->getNameFormComponent(),
        $this->getEmailFormComponent(), */
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
          ])
      ]);
  }
}
