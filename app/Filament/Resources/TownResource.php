<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TownResource\Pages;
use App\Filament\Resources\TownResource\RelationManagers;
use App\Models\Town;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TownResource extends Resource
{
  protected static ?string $model = Town::class;
  protected static ?string $navigationParentItem = 'Provincias';
  protected static ?string $navigationGroup = 'Configuración';
  protected static ?string $label = 'Corregimientos';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Corregimiento')
          ->description('Ingrese los datos del corregimiento.')
          ->schema([
            Forms\Components\TextInput::make('name')
              ->label('Nombre')
              ->required()
              ->maxLength(255),
            Forms\Components\Select::make('state_id')
              ->label('Provincia')
              ->relationship('state', 'name')
              ->required(),
            Forms\Components\Select::make('city_id')
              ->label('Distrito')
              ->relationship('city', 'name')
              ->required(),
          ])->columns(3)
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Corregimiento')
          ->searchable(),
        Tables\Columns\TextColumn::make('state.name')
          ->label('Provincia')
          ->sortable(),
        Tables\Columns\TextColumn::make('city.name')
          ->label('Distrito')
          ->sortable(),
        Tables\Columns\TextColumn::make('created_at')
          ->label('Creado el')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->label('Actualizado el')
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
      'index' => Pages\ListTowns::route('/'),
      'create' => Pages\CreateTown::route('/create'),
      'edit' => Pages\EditTown::route('/{record}/edit'),
    ];
  }
}
