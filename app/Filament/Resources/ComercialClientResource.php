<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComercialClientResource\Pages;
use App\Filament\Resources\ComercialClientResource\RelationManagers;
use App\Models\City;
use App\Models\ComercialClient;
use App\Models\Town;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ComercialClientResource extends Resource
{
  protected static ?string $model = ComercialClient::class;
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?string $pluralModelLabel = 'Clientes Comerciales';
  protected static ?string $navigationLabel = 'Clientes Comerciales';
  protected static ?string $modelLabel = 'Cliente Comercial';
  protected static ?string $navigationIcon = 'fas-store';
  protected static ?int $navigationSort = 3;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Cliente Comercial')
          ->description('Ingrese los datos del cliente comercial.')
          ->schema([
            Forms\Components\TextInput::make('nic')
              ->label('NIC')
              ->required()
              ->maxLength(10),
            Forms\Components\TextInput::make('finca')
              ->label('Finca')
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('ruc')
              ->label('RUC')
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('name')
              ->label('Nombre')
              ->required()
              ->maxLength(255)
              ->columnSpanFull(),
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
              ->maxLength(255)
              ->columnSpanFull(),
          ])->columns(3),
        Section::make([
          Split::make([
            Section::make('Calculo de Tarifa de Aseo')
              ->description('Ingrese los datos de la generación de desechos para calcular la tasa de aseo.')
              ->schema([
                Forms\Components\TextInput::make('cantidad_bolsas')
                  ->label('Cant. de Bolsas')
                  ->numeric()
                  ->live(onBlur: true)
                  ->maxLength(3)
                  ->default('1')
                  ->afterStateUpdated(function (Get $get, Set $set) {
                    Self::promedioBolsaDiaria($get, $set);
                    Self::promedioBolsaMensuales($get, $set);
                    Self::promedioGalonesMensuales($get, $set);
                    Self::metroCubicosMensuales($get, $set);
                    Self::yardasCubicasMensuales($get, $set);
                    Self::tarifaMetros($get, $set);
                    Self::tarifaYardas($get, $set);
                  })
                  ->columnSpan(1),
                Forms\Components\TextInput::make('generacion')
                  ->label('Frec. de generación (en días)')
                  ->numeric()
                  ->live(onBlur: true)
                  ->maxLength(3)
                  ->default('1')
                  ->afterStateUpdated(function (Get $get, Set $set) {
                    Self::promedioBolsaDiaria($get, $set);
                    Self::promedioBolsaMensuales($get, $set);
                    Self::promedioGalonesMensuales($get, $set);
                    Self::metroCubicosMensuales($get, $set);
                    Self::yardasCubicasMensuales($get, $set);
                    Self::tarifaMetros($get, $set);
                    Self::tarifaYardas($get, $set);
                  }),
                Forms\Components\Select::make('dias_laborables')
                  ->label('Cant. de días laborables')
                  ->options([
                    '22' => 'Lunes a Viernes',
                    '24' => 'Lunes a Sábado (medio dia)',
                    '26' => 'Lunes a Sábado',
                    '28' => 'Lunes a Domingo (medio dia)',
                    '30' => 'Lunes a Domingo',
                  ])
                  ->live(onBlur: true)
                  ->native(false)
                  ->afterStateUpdated(function (Get $get, Set $set) {
                    Self::promedioBolsaMensuales($get, $set);
                    Self::promedioGalonesMensuales($get, $set);
                    Self::metroCubicosMensuales($get, $set);
                    Self::yardasCubicasMensuales($get, $set);
                    Self::tarifaMetros($get, $set);
                    Self::tarifaYardas($get, $set);
                  }),
                Forms\Components\Select::make('tipo_bolsa')
                  ->label('Tipo de Bolsas')
                  ->options([
                    '12' => '13 galones',
                    '31.5' => '33 galones',
                    '49.5' => '55 galones',
                    '55' => '55 galones (tanque)',
                  ])
                  ->native(false)
                  ->live(onBlur: true)
                  ->afterStateUpdated(function (Get $get, Set $set) {
                    Self::promedioGalonesMensuales($get, $set);
                    Self::metroCubicosMensuales($get, $set);
                    Self::yardasCubicasMensuales($get, $set);
                    Self::tarifaMetros($get, $set);
                    Self::tarifaYardas($get, $set);
                  })
              ])->grow(false),
            Section::make('Calculo de Tarifa de Aseo')
              ->description('Ingrese los datos de la generación de desechos para calcular la tasa de aseo.')
              ->schema([
                Forms\Components\TextInput::make('prom_bolsa_diaria')
                  ->label('Prom. de Bolsas Diarias')
                  ->live(onBlur: true)
                  ->afterStateUpdated(function (Get $get, Set $set) {
                    Self::promedioBolsaMensuales($get, $set);
                  })
                  ->disabled()
                  ->dehydrated(),
                Forms\Components\TextInput::make('prom_bolsa_mensual')
                  ->label('Prom. de Bolsas Mensuales')
                  ->live(onBlur: true)
                  ->disabled()
                  ->dehydrated(),
                Forms\Components\TextInput::make('prom_gal_mensual')
                  ->label('Prom. de Galones Mensuales')
                  ->live(onBlur: true)
                  ->afterStateUpdated(function (Get $get, Set $set) {
                    Self::metroCubicosMensuales($get, $set);
                    Self::yardasCubicasMensuales($get, $set);
                  })
                  ->disabled()
                  ->dehydrated(),
                Forms\Components\TextInput::make('mts_cub_mensual')
                  ->label('Metros Cúbicos Mensuales')
                  ->live(onBlur: true)
                  ->disabled()
                  ->dehydrated(),
                Forms\Components\TextInput::make('yrd_cub_mensual')
                  ->label('Yardas Cúbicas Mensuales')
                  ->live(onBlur: true)
                  ->disabled()
                  ->dehydrated(),
                Forms\Components\TextInput::make('tarifa_mts')
                  ->label('Tarifa (mts)')
                  ->live(onBlur: true)
                  ->disabled()
                  ->dehydrated(),
                Forms\Components\TextInput::make('tarifa_yd')
                  ->label('Tarifa (yd)')
                  ->live(onBlur: true)
                  ->disabled()
                  ->dehydrated(),
              ])
          ])
        ]),

        Section::make('Convenio Bancario')
          ->description('Active este botón si el cliente tiene conveni de pago bancario.')
          ->schema([
            Forms\Components\Toggle::make('convenio_bancario')
              ->default(false),
          ])

      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('nic')
          ->searchable(),
        Tables\Columns\TextColumn::make('finca')
          ->searchable(),
        Tables\Columns\TextColumn::make('ruc')
          ->searchable(),
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('state_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('city_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('town_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('address')
          ->searchable(),
        Tables\Columns\IconColumn::make('convenio_bancario')
          ->boolean(),
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
      'index' => Pages\ListComercialClients::route('/'),
      'create' => Pages\CreateComercialClient::route('/create'),
      'edit' => Pages\EditComercialClient::route('/{record}/edit'),
    ];
  }

  public static function promedioBolsaDiaria(Get $get, Set $set): void
  {
    $set('prom_bolsa_diaria', round($get('cantidad_bolsas') / $get('generacion'), 2));
  }

  public static function promedioBolsaMensuales(Get $get, Set $set): void
  {
    $set('prom_bolsa_mensual', round($get('prom_bolsa_diaria') * $get('dias_laborables'), 2));
  }

  public static function promedioGalonesMensuales(Get $get, Set $set): void
  {
    $set('prom_gal_mensual', round($get('prom_bolsa_mensual') * $get('tipo_bolsa'), 2));
  }

  public static function metroCubicosMensuales(Get $get, Set $set): void
  {
    $set('mts_cub_mensual', round($get('prom_gal_mensual') / 264.172, 2));
  }

  public static function yardasCubicasMensuales(Get $get, Set $set): void
  {
    $set('yrd_cub_mensual', round($get('prom_gal_mensual') / 201.974, 2));
  }

  public static function tarifaMetros(Get $get, Set $set): void
  {
    $set('tarifa_mts', round($get('mts_cub_mensual') * 18.70, 2));
  }

  public static function tarifaYardas(Get $get, Set $set): void
  {
    $set('tarifa_yd', round($get('yrd_cub_mensual') * 14.30, 2));
  }
}
