<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
  protected static ?string $model = User::class;
  protected static ?string $label = 'Usuarios';
  protected static ?string $navigationIcon = 'fas-user-group';
  protected static ?string $navigationGroup = 'Configuración';
  protected static ?int $navigationSort = 4;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Usuario')
          ->description('Ingrese los datos del usuario.')
          ->schema([
            Forms\Components\TextInput::make('name')
              ->label('Nombre de Usuario')
              ->required()
              ->maxLength(255),
            Forms\Components\Select::make('employee_id')
              ->label('Nombre del funcionario')
              ->relationship('employee', 'fullname')
              ->searchable()
              ->required(),
            Forms\Components\TextInput::make('email')
              ->email()
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('password')
              ->password()
              ->dehydrateStateUsing(fn($state) => Hash::make($state))
              ->dehydrated(fn($state) => filled($state))
              //->required(fn(string $context): bool => $context === 'create')
              ->required(fn (Page $livewire) => ($livewire instanceof CreateRecord))
              ->maxLength(12),
            Select::make('roles')->multiple()->relationship('roles', 'name'),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('email')
          ->searchable(),
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
        Tables\Actions\EditAction::make(),
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
