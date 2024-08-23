<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
  protected static ?string $model = Role::class;
  protected static ?string $navigationGroup = 'Seguridad';
  protected static ?string $label = 'Roles';
  protected static ?int $navigationSort = 4;
  protected static ?string $navigationIcon = 'fas-user-shield';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Roles de los usuarios')
          ->description('Cree el rol para el usuario.')
          ->schema([
            Forms\Components\TextInput::make('name')
              ->label('Nombre del Role')
              ->required()
              ->maxLength(255),
            Forms\Components\Hidden::make('guard_name')
              ->default('web')
              ->dehydrated(),
            Select::make('permissions')
              ->label('Permisos')
              ->multiple()
              ->relationship('permissions', 'name')
              ->preload(),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Nombre del Rol')
          ->searchable(),
/*         Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true), */
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
      'index' => Pages\ListRoles::route('/'),
      'create' => Pages\CreateRole::route('/create'),
      'edit' => Pages\EditRole::route('/{record}/edit'),
    ];
  }
}
