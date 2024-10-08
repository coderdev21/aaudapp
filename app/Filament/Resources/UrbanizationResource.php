<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UrbanizationResource\Pages;
use App\Filament\Resources\UrbanizationResource\RelationManagers;
use App\Models\City;
use App\Models\Town;
use App\Models\Urbanization;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Collection;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UrbanizationResource extends Resource
{
  protected static ?string $model = Urbanization::class;
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?string $pluralModelLabel = 'Proyectos';
  protected static ?string $navigationLabel = 'Proyectos';
  protected static ?string $modelLabel = 'Proyecto';
  protected static ?string $navigationIcon = 'fas-city';
  protected static ?int $navigationSort = 5;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Pryecto')
          ->description('Ingrese los datos del proyecto')
          ->schema([
            Forms\Components\Select::make('state_id')
              ->label('Provincia')
              ->relationship('state', 'name')
              ->searchable()
              ->required()
              ->preload()
              ->live()
              ->afterStateUpdated(function (Set $set) {
                $set('city_id', null);
                $set('town_id', null);
              }),
            Forms\Components\Select::make('city_id')
              ->label('Distrito')
              ->options(fn(Get $get): Collection => City::query()
                ->where('state_id', $get('state_id'))
                ->pluck('name', 'id'))
              ->searchable()
              ->preload()
              ->live()
              ->afterStateUpdated(function (Set $set) {
                $set('town_id', null);
              })
              ->required(),
            Forms\Components\Select::make('town_id')
              ->label('Corregimiento')
              ->options(fn(Get $get): Collection => Town::query()
                ->where('city_id', $get('city_id'))
                ->pluck('name', 'id'))
              ->searchable()
              ->preload()
              ->live()
              ->required(),
            Forms\Components\TextInput::make('name')
              ->label('Nombre del Proyecto')
              ->required()
              ->maxLength(255),
          ])->columns(3)
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Nombre del Proyecto')
          ->searchable(),
        Tables\Columns\TextColumn::make('state.name')
          ->label('Provincia')
          ->sortable(),
        Tables\Columns\TextColumn::make('city.name')
          ->label('Distrito')
          ->sortable(),
        Tables\Columns\TextColumn::make('town.name')
          ->label('Corregimiento')
          ->sortable(),
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
        Tables\Actions\ViewAction::make()
          ->iconButton(),
        Tables\Actions\EditAction::make()
          ->iconButton(),
        Tables\Actions\DeleteAction::make()
          ->iconButton(),
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
      'index' => Pages\ListUrbanizations::route('/'),
      'create' => Pages\CreateUrbanization::route('/create'),
      'edit' => Pages\EditUrbanization::route('/{record}/edit'),
    ];
  }
}
