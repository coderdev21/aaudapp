<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\City;
use App\Models\Customer;
use App\Models\Town;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Filament\Infolists\Components;

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
        Section::make('Datos del Cliente')
          ->description('Ingrese los datos del cliente')
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
            Forms\Components\Select::make('actividad')
              ->label('Actividad')
              ->required()
              ->options([
                'COMERCIAL' => 'COMERCIAL',
                'RESIDENCIAL' => 'RESIDENCIAL',
              ]),
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
            Forms\Components\TextInput::make('address')
              ->label('Dirección')
              ->required()
              ->maxLength(255),
            Forms\Components\Hidden::make('created_by')
              ->required()
              ->default(Auth::user()->id)
              ->dehydrated(),
          ])->columns(4),
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

  public static function infolist(Infolist $infolist): Infolist
  {
    return $infolist
      ->schema([
        Components\Section::make('Ver Cliente')
          ->description('Estos son los datos del cliente')
          ->schema([
            Components\TextEntry::make('nic')
              ->label('NIC'),
            Components\TextEntry::make('finca')
              ->label('No. de Finca'),
            Components\TextEntry::make('actividad')
              ->label('Actividad la que se dedica'),
            Components\TextEntry::make('name')
              ->label('Titular de la cuenta')
              ->columnSpanFull(),
            Components\TextEntry::make('town.name')
              ->label('Corregimiento'),
            Components\TextEntry::make('city.name')
              ->label('Distrito'),
            Components\TextEntry::make('state.name')
              ->label('Provincia'),
            Components\TextEntry::make('address')
              ->label('Dirección')
              ->columnSpanFull(),
          ])->columns(3),
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
