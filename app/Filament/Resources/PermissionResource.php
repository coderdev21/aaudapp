<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Filament\Resources\PermissionResource\RelationManagers;
use App\Models\Permission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionResource extends Resource
{
  protected static ?string $model = Permission::class;
  protected static ?string $navigationGroup = 'Seguridad';
  protected static ?string $label = 'Permisos';
  protected static ?int $navigationSort = 4;
  protected static ?string $navigationIcon = 'fas-user-lock';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->label('Nombre del Permiso')
          ->required()
          ->maxLength(255),
        Forms\Components\Hidden::make('guard_name')
          ->default('web')
          ->dehydrated(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
        ->label('Nombre del Permiso')
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
      'index' => Pages\ListPermissions::route('/'),
      'create' => Pages\CreatePermission::route('/create'),
      'edit' => Pages\EditPermission::route('/{record}/edit'),
    ];
  }
}
