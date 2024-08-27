<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
  protected static ?string $model = City::class;
  protected static ?string $navigationParentItem = 'Provincias';
  protected static ?string $navigationGroup = 'Configuración';
  protected static ?string $label = 'Distritos';
  //protected static ?string $navigationIcon = 'fas-flag';
  //protected static ?int $navigationSort = 6;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Distrito')
          ->description('Ingrese los datos del distrito.')
          ->schema([
            Forms\Components\TextInput::make('name')
              ->label('Nombre')
              ->required()
              ->maxLength(255),
            Forms\Components\Select::make('state_id')
              ->label('Provincia')
              ->relationship('state', 'name')
              ->required(),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Distrito')
          ->searchable(),
        Tables\Columns\TextColumn::make('state.name')
          ->label('Provincia')
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
      'index' => Pages\ListCities::route('/'),
      'create' => Pages\CreateCity::route('/create'),
      'edit' => Pages\EditCity::route('/{record}/edit'),
    ];
  }
}
