<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Certificate;
use App\Models\City;
use App\Models\Customer;
use App\Models\Town;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Tables\Actions\Action;
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
use Filament\Forms\Components\Split;
use Illuminate\Support\Facades\DB;

class CustomerResource extends Resource
{
  protected static ?string $model = Customer::class;
  protected static ?string $label = 'Clientes';
  protected static ?string $navigationIcon = 'fas-house-user';
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?int $navigationSort = 1;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make([
          Split::make([
            Section::make('Datos del Cliente')
              ->description('Ingrese los datos del cliente.')
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
                Forms\Components\TextInput::make('cedula')
                  ->label('Cédula')
                  ->maxLength(16),
                Forms\Components\TextInput::make('email')
                  ->label('Correo Electrónico')
                  ->maxLength(255),
                Forms\Components\TextInput::make('telefono')
                  ->label('Teléfono')
                  ->maxLength(255),
              ])->columns(3),
            Section::make('Condición de la cuenta')
              ->description('Seleccine en que condición se encuentra la cuenta.')
              ->schema([
                Forms\Components\Toggle::make('arreglo_pago')
                  ->label('Arreglo de Pago')
                  ->default(false),
                Forms\Components\Toggle::make('convenio_bancario')
                  ->label('Convencio Bancario')
                  ->default(false),
              ])->grow(false),
          ]),
          Section::make('Dirección')
            ->description('Ingrese la dirección del cliente.')
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
              Forms\Components\TextInput::make('address')
                ->label('Dirección')
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            ])->columns(3),
        ]),
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
        Tables\Columns\IconColumn::make('arreglo_pago')
          ->label('Arreglo de Pago')
          ->boolean()
          ->trueIcon('fas-circle-exclamation')
          ->falseIcon('fas-circle-check')
          ->trueColor('warning')
          ->falseColor('gray'),
        Tables\Columns\IconColumn::make('convenio_bancario')
          ->label('Convenio Bancario')
          ->boolean()
          ->trueIcon('fas-circle-exclamation')
          ->falseIcon('fas-circle-check')
          ->trueColor('warning')
          ->falseColor('gray'),
      ])
      ->filters([
        //
      ])
      ->actions([
        Action::make('Crear Paz y Salvo')
          ->iconButton()
          ->icon('fas-file-invoice')
          ->color('info')
          ->form([
            Section::make('Datos del Cliente')
              ->description('Ingrese el NIC de la cuenta que desea imprimir el paz y salvo')
              ->schema([
                Forms\Components\TextInput::make('customer_id')
                  ->label('Customer ID')
                  ->default(function ($record) {
                    return $record->id;
                  })
                  ->disabled()
                  ->dehydrated()
                  ->columns(2),
                Forms\Components\TextInput::make('nic')
                  ->default(function ($record) {
                    return $record->nic;
                  })
                  ->dehydrated(),
                Forms\Components\TextInput::make('finca')
                  ->label('No. de Finca:')
                  ->default(function ($record) {
                    return $record->finca;
                  })
                  ->disabled()
                  ->dehydrated(),
                Forms\Components\TextInput::make('customer_name')
                  ->label('Nombre del cliente:')
                  ->default(function ($record) {
                    return $record->name;
                  })
                  ->disabled()
                  ->dehydrated(),
                Forms\Components\Select::make('state_id')
                  ->label('Provincia:')
                  ->relationship('state', 'name')
                  ->required()
                  ->disabled()
                  ->default(function ($record) {
                    return $record->state_id;
                  })
                  ->dehydrated(),
                Forms\Components\Select::make('city_id')
                  ->label('Distrito:')
                  ->relationship('city', 'name')
                  ->required()
                  ->disabled()
                  ->default(function ($record) {
                    return $record->city_id;
                  })
                  ->dehydrated(),
                Forms\Components\Select::make('town_id')
                  ->label('Corregimiento:')
                  ->relationship('town', 'name')
                  ->required()
                  ->disabled()
                  ->default(function ($record) {
                    return $record->town_id;
                  })
                  ->dehydrated(),
                Forms\Components\TextInput::make('address')
                  ->label('Dirección:')
                  ->required()
                  ->disabled()
                  ->dehydrated()
                  ->default(function ($record) {
                    return $record->address;
                  })
                  ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                  ->label('Observación')
                  ->columnSpanFull(),
                Forms\Components\TextInput::make('user_id')
                  ->default(Auth::user()->id)
                  ->dehydrated(),
                Forms\Components\TextInput::make('agency_id')
                  ->default(Auth::check() ? Auth::user()->employee->agency->id : 'No user')
                  ->dehydrated(),
              ])->columns(3)
          ])
          ->action(
            function (Customer $record, array $data) {
              //Busca en la tabla 'certificates' el ultimo id y le suma uno mas
              //para agregarlo al 'control_number'
              $lastRecordId = DB::table('certificates')->max('id');
              $nextId = $lastRecordId ? $lastRecordId + 1 : 1;
              $currentYear = Carbon::now()->year;
              $data['control_number'] = 'CT-' . $nextId . '-' . $currentYear;

              //Agrega la fecha de hoy y le suma 30 días
              $data['expiration_date'] = Carbon::now()->addDays(30);
              Certificate::create([
                'control_number'  => $data['control_number'],
                'expiration_date' => $data['expiration_date'],
                'customer_id'     => $data['customer_id'],
                'nic'             => $data['nic'],
                'finca'           => $data['finca'],
                'customer_name'   => $data['customer_name'],
                'state_id'        => $data['state_id'],
                'city_id'         => $data['city_id'],
                'town_id'         => $data['town_id'],
                'address'         => $data['address'],
                'description'     => $data['description'],
                'agency_id'       => $data['agency_id'],
                'user_id'         => $data['user_id']
              ]);
            }
          ),
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
