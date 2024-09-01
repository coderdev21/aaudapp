<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StateResource extends Resource
{
  protected static ?string $model = State::class;
  protected static ?string $label = 'Provincias';
  protected static ?string $navigationIcon = 'fas-flag';
  protected static ?string $navigationGroup = 'Configuración';
  protected static ?int $navigationSort = 5;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos la Provincia')
          ->description('Ingrese los datos de la provincia.')
          ->schema([
            Forms\Components\TextInput::make('name')
              ->label('Nombre')
              ->required()
              ->maxLength(255),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Provincia')
          ->searchable(),
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
      'index' => Pages\ListStates::route('/'),
      'create' => Pages\CreateState::route('/create'),
      'edit' => Pages\EditState::route('/{record}/edit'),
    ];
  }
}
