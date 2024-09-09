<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerOmissionResource\Pages;
use App\Filament\Resources\CustomerOmissionResource\RelationManagers;
use App\Models\CustomerOmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Auth;

class CustomerOmissionResource extends Resource
{
  protected static ?string $model = CustomerOmission::class;
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?string $pluralModelLabel = 'Clientes por Omisión';
  protected static ?string $navigationLabel = 'Clientes por Omisión';
  protected static ?string $modelLabel = 'Cliente por Omisión';
  protected static ?string $navigationIcon = 'fas-people-roof';
  protected static ?int $navigationSort = 2;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Cliente por Omisión')
          ->description('Ingrese los datos del cliente por omisión.')
          ->schema([
            Forms\Components\TextInput::make('contrato')
              ->label('Número de Contrato')
              ->required()
              ->maxLength(9),
            Forms\Components\DateTimePicker::make('start')
              ->label('Fecha de Inicio')
              ->required(),
            Forms\Components\TextInput::make('finca')
              ->label('Número de Finca')
              ->required()
              ->maxLength(255),
            Forms\Components\Select::make('customer_type_id')
              ->label('Tipo de Cliente')
              ->relationship('customerType', 'name')
              ->required(),
            Forms\Components\TextInput::make('name')
              ->label('Nombre del Cliente')
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('cedula')
              ->label('Cédula')
              ->required()
              ->maxLength(255),
            Forms\Components\Select::make('tasa_id')
              ->label('Tasa de Aseo')
              ->relationship('tasa', 'tasa')
              ->required(),
            Forms\Components\TextInput::make('telefono')
              ->label('Teléfono')
              ->tel()
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('email')
              ->label('Correo Electrónico')
              ->email()
              ->required()
              ->maxLength(255),
            Forms\Components\Select::make('urbanization_id')
              ->label('Proyecto')
              ->searchable()
              ->preload()
              ->relationship('urbanization', 'name')
              ->required(),
            Forms\Components\TextInput::make('status')
              ->label('Status')
              ->required()
              ->maxLength(255),
            Forms\Components\Hidden::make('user_id')
              ->default(Auth::user()->id)
              ->dehydrated(),
            Forms\Components\Hidden::make('agency_id')
              ->default(Auth::check() ? Auth::user()->employee->agency->id : 'No user')
              ->dehydrated(),
          ])->columns(4)
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('contrato')
          ->searchable(),
        Tables\Columns\TextColumn::make('finca')
          ->searchable(),
        Tables\Columns\TextColumn::make('customer_type_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('tasa_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('start')
          ->dateTime()
          ->sortable(),
        Tables\Columns\TextColumn::make('agency_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('cedula')
          ->searchable(),
        Tables\Columns\TextColumn::make('telefono')
          ->searchable(),
        Tables\Columns\TextColumn::make('email')
          ->searchable(),
        Tables\Columns\TextColumn::make('urbanization_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('status')
          ->searchable(),
        Tables\Columns\TextColumn::make('user_id')
          ->numeric()
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
      'index' => Pages\ListCustomerOmissions::route('/'),
      'create' => Pages\CreateCustomerOmission::route('/create'),
      'edit' => Pages\EditCustomerOmission::route('/{record}/edit'),
    ];
  }
}
