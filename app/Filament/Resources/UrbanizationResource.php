<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UrbanizationResource\Pages;
use App\Filament\Resources\UrbanizationResource\RelationManagers;
use App\Models\Urbanization;
use Filament\Forms;
use Filament\Forms\Form;
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
  protected static ?string $label = 'Proyectos';
  protected static ?string $navigationIcon = 'fas-city';
  protected static ?int $navigationSort = 4;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Select::make('state_id')
          ->relationship('state', 'name')
          ->required(),
        Forms\Components\Select::make('city_id')
          ->relationship('city', 'name')
          ->required(),
        Forms\Components\Select::make('town_id')
          ->relationship('town', 'name')
          ->required(),
        Forms\Components\TextInput::make('name')
          ->required()
          ->maxLength(255),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('state.name')
          ->sortable(),
        Tables\Columns\TextColumn::make('city.name')
          ->sortable(),
        Tables\Columns\TextColumn::make('town.name')
          ->sortable(),
        Tables\Columns\TextColumn::make('name')
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
      'index' => Pages\ListUrbanizations::route('/'),
      'create' => Pages\CreateUrbanization::route('/create'),
      'edit' => Pages\EditUrbanization::route('/{record}/edit'),
    ];
  }
}
