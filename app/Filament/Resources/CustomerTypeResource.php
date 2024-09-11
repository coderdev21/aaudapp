<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerTypeResource\Pages;
use App\Filament\Resources\CustomerTypeResource\RelationManagers;
use App\Models\CustomerType;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerTypeResource extends Resource
{
  protected static ?string $model = CustomerType::class;
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?string $pluralModelLabel = 'Tipos de Clientes';
  protected static ?string $navigationLabel = 'Tipo de Cliente';
  protected static ?string $modelLabel = 'Tipo de Cliente';
  protected static ?string $navigationIcon = 'fas-user-tag';
  protected static ?int $navigationSort = 6;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Tipo de Cliente')
          ->description('Ingrese el tipo de cliente que desea crear')
          ->schema([
            Forms\Components\TextInput::make('name')
              ->label('Tipo de Cliente')
              ->required()
              ->maxLength(20),
          ])->columns(4)
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Tipo de Cliente'),
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
      'index' => Pages\ListCustomerTypes::route('/'),
      'create' => Pages\CreateCustomerType::route('/create'),
      'edit' => Pages\EditCustomerType::route('/{record}/edit'),
    ];
  }
}
