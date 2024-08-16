<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
  protected static ?string $model = Customer::class;
  protected static ?string $label = 'Clientes';
  protected static ?string $navigationIcon = 'fas-house-user';
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?int $navigationSort = 3;
  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('nic')
          ->label('NIC')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('finca')
          ->label('No. Finca')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('name')
          ->label('Nombre')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('actividad')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('state')
          ->required(),
        Forms\Components\TextInput::make('city')
          ->required(),
        Forms\Components\TextInput::make('town')
          ->required(),
        Forms\Components\TextInput::make('address')
          ->required()
          ->maxLength(255),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('nic')
          ->label('Nic')
          ->searchable(),
        Tables\Columns\TextColumn::make('finca')
          ->label('No. Finca')
          ->searchable(),
        Tables\Columns\TextColumn::make('name')
          ->label('Nombre')
          ->searchable(),
        /*Tables\Columns\TextColumn::make('state.name')
                    ->label('Provincia'),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Distrito'),
                Tables\Columns\TextColumn::make('town.name')
                    ->label('Corregimiento'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Dirección') */
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
      'index' => Pages\ListCustomers::route('/'),
      'create' => Pages\CreateCustomer::route('/create'),
      'edit' => Pages\EditCustomer::route('/{record}/edit'),
    ];
  }
}
