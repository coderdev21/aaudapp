<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Bool_;
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;

class UserResource extends Resource
{
  protected static ?string $model = User::class;
  protected static ?string $navigationGroup = 'Configuración';
  protected static ?string $label = 'Usuarios';
  protected static ?string $navigationIcon = 'fas-user-group';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Usuario')
          ->description('Ingrese los datos del usuario.')
          ->schema([
            Forms\Components\TextInput::make('name')
              //->email()
              ->required()
              ->suffix('@aaud.gob.pa')
              ->afterStateUpdated(fn(Set $set, ?string $state) => $set('email', $state.'@aaud.gob.pa'))
              ->maxLength(255),
            Forms\Components\Select::make('employee_id')
              ->label('Nombre del funcionario')
              ->relationship('employee', 'fullname')
              ->searchable()
              ->required(),
            Forms\Components\Hidden::make('email')
              ->required()
              ->dehydrated(),
          ])->columns(3),
        Section::make('Roles del Usuario')
          ->description('Ingrese los roles que tendrá el usuario en el sistema.')
          ->schema([
            Select::make('roles')
              ->relationship('roles', 'name')
              ->multiple()
              ->searchable()
              ->preload(),
          ]),
        Section::make('Cambiar contraseña')
          ->description('El usuario deberá cambiar la contraseña en el prómximo inicio de sesión.')
          ->schema([
            Toggle::make('force_renew_password')
              ->label('Reestablecer contraseña')
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('id', 1))
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Nombre de Usuario')
          ->searchable(),
        Tables\Columns\TextColumn::make('email')
          ->label('Correo Eléctronico')
          ->searchable(),
        Tables\Columns\TextColumn::make('employee.fullname')
          ->label('Funcionario')
          ->searchable(),
        Tables\Columns\IconColumn::make('force_renew_password')
          ->label('Cambio de Contraseña')
          ->boolean(),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListUsers::route('/'),
      'create' => Pages\CreateUser::route('/create'),
      'edit' => Pages\EditUser::route('/{record}/edit'),
    ];
  }
}
