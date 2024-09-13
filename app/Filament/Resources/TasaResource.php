<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TasaResource\Pages;
use App\Filament\Resources\TasaResource\RelationManagers;
use App\Models\Tasa;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TasaResource extends Resource
{
  protected static ?string $model = Tasa::class;
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?string $pluralModelLabel = 'Tasas de Aseo';
  protected static ?string $navigationLabel = 'Tasa de Aseo';
  protected static ?string $modelLabel = 'Tasa';
  protected static ?string $navigationIcon = 'fas-money-bill-1-wave';
  protected static ?int $navigationSort = 5;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Tasa de Aseo')
          ->description('Ingrese la tasa de Aseo.')
          ->schema([
            Forms\Components\TextInput::make('tasa')
            ->prefix('B/.')
              ->required()
          ])->columns(4)
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('tasa')
        ->label('Tasa de Aseo Residencial')
          ->money('B/.', locale: 'pa'),
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
      'index' => Pages\ListTasas::route('/'),
      'create' => Pages\CreateTasa::route('/create'),
      'edit' => Pages\EditTasa::route('/{record}/edit'),
    ];
  }
}
