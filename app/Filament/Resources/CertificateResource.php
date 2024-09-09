<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificateResource\Pages;
use App\Filament\Resources\CertificateResource\RelationManagers;
use App\Models\Certificate;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\App;
use Rmsramos\Activitylog\Actions\ActivityLogTimelineTableAction;
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;

class CreateCertificateRecord extends CreateRecord
{
  protected static string $resource = CertificateResource::class;

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    // If needed, you can further manipulate the data here before saving.
    //dd($data);
    return $data;
  }
}

class CertificateResource extends Resource
{

  protected static ?string $model = Certificate::class;
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?string $pluralModelLabel = 'Paz y Salvos';
  protected static ?string $navigationLabel = 'Paz y Salvos';
  protected static ?string $modelLabel = 'Paz y Salvo';
  protected static ?string $navigationIcon = 'fas-file-invoice';
  protected static ?int $navigationSort = 3;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos del Cliente')
          ->description('Ingrese el NIC de la cuenta que desea imprimir el paz y salvo')
          ->schema([
            Forms\Components\Select::make('customer_id')
              ->label('NIC')
              ->relationship('customer', 'nic')
              ->searchable()
              ->required()
              ->live()
              ->afterStateUpdated(function (Set $set, Get $get) {
                $set('nic', Customer::find($get('customer_id'))->nic);
                $set('finca', Customer::find($get('customer_id'))->finca);
                $set('customer_name', Customer::find($get('customer_id'))->name);
                $set('state_id', Customer::find($get('customer_id'))->state_id);
                $set('city_id', Customer::find($get('customer_id'))->city_id);
                $set('town_id', Customer::find($get('customer_id'))->town_id);
                $set('address', Customer::find($get('customer_id'))->address);
              })
              ->columns(2),
            Forms\Components\Hidden::make('nic')
              ->dehydrated(),
            Forms\Components\TextInput::make('finca')
              ->label('No. de Finca:')
              ->required()
              ->disabled()
              ->dehydrated(),
            Forms\Components\TextInput::make('customer_name')
              ->label('Nombre del cliente:')
              ->required()
              ->disabled()
              ->dehydrated(),
            Forms\Components\Select::make('state_id')
              ->label('Provincia:')
              ->relationship('state', 'name')
              ->required()
              ->disabled()
              ->dehydrated(),
            Forms\Components\Select::make('city_id')
              ->label('Distrito:')
              ->relationship('city', 'name')
              ->required()
              ->disabled()
              ->dehydrated(),
            Forms\Components\Select::make('town_id')
              ->label('Corregimiento:')
              ->relationship('town', 'name')
              ->required()
              ->disabled()
              ->dehydrated(),
            Forms\Components\TextInput::make('address')
              ->label('Dirección:')
              ->required()
              ->disabled()
              ->dehydrated()
              ->columnSpanFull(),
            Forms\Components\Textarea::make('description')
              ->label('Observación')
              ->columnSpanFull(),
            Forms\Components\Hidden::make('user_id')
              //->label('Elaborado por:')
              /*               ->default(function () {
                $name = Auth::user()->employee->nombre . ' ' . Auth::user()->employee->apellido_paterno;
                return $name;
              }) */
              ->default(Auth::user()->id)
              //->disabled()
              ->dehydrated(),
            Forms\Components\Hidden::make('agency_id')
              //->label('Agencia')
              ->default(Auth::check() ? Auth::user()->employee->agency->id : 'No user')
              //->disabled()
              ->dehydrated(),
          ])->columns(3),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('created_at')
          ->label('Fecha de Emisión')
          ->dateTime('Y-m-d')
          ->sortable(),
        Tables\Columns\TextColumn::make('expiration_date')
          ->label('Valido Hasta')
          ->dateTime('Y-m-d')
          ->badge()
          ->color(function ($state) {
            if (Carbon::parse($state)->gt(Carbon::now())) {
              return 'success';
            } else {
              return 'danger';
            }
          })
          ->sortable(),
        Tables\Columns\TextColumn::make('control_number')
          ->label('Número')
          ->searchable(),
        Tables\Columns\TextColumn::make('nic')
          ->label('NIC')
          ->searchable(),
        /*         Tables\Columns\TextColumn::make('control_number')
          ->label('Numero de Control')
          ->searchable(), */
        /* Tables\Columns\TextColumn::make('customer_name')
          ->label('Cliente')
          ->sortable(), */
        Tables\Columns\TextColumn::make('agency.name')
          ->label('Agencia')
          ->sortable(),
        Tables\Columns\TextColumn::make('user.employee.shortfullname')
          ->label('Creado por')
          ->sortable(),
        /*         Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true), */
      ])
      ->defaultSort('created_at', 'desc')
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\Action::make('download')
          //->label('Imprimir')
          ->icon('fas-file-invoice')
          ->iconButton()
          ->url(
            fn($record): string => route('pdf.pazysalvo', ['id' => $record->id]),
            shouldOpenInNewTab: true
          )
          ->color('info'),
        Tables\Actions\ViewAction::make()
          ->iconButton(),
        Tables\Actions\EditAction::make()
          ->iconButton(),
        ActivityLogTimelineTableAction::make('Activities')
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
        Components\Section::make('Verificación de Paz y Salvo')
          ->description('Verifique los datos conincidan con la copia impresa.')
          ->schema([
            Components\TextEntry::make('control_number')
              ->label('No. de Control'),
            Components\TextEntry::make('created_at')
              ->label('Fecha de Emisión')
              ->formatStateUsing(function ($state) {
                Carbon::setlocale(config('app.locale'));
                return Carbon::parse($state)->translatedFormat('d F Y');
              }),
            Components\TextEntry::make('user.employee.shortfullname')
              ->label('Funcionario'),
            Components\TextEntry::make('agency.name')
              ->label('Agencia'),
            Components\TextEntry::make('expiration_date')
              ->label('Fecha de Expiración')
              ->badge()
              ->color(function ($state) {
                if (Carbon::parse($state)->gt(Carbon::now())) {
                  return 'success';
                } else {
                  return 'danger';
                }
              })
              ->formatStateUsing(function ($state) {
                Carbon::setlocale(config('app.locale'));
                return Carbon::parse($state)->translatedFormat('d F Y');
              }),
          ])->columns(5),
        Components\Section::make('Datos del Cliente')
          ->description('Verifique los datos conincidan con la copia impresa.')
          ->schema([
            Components\TextEntry::make('nic')
              ->label('Nic'),
            Components\TextEntry::make('finca')
              ->label('Finca')
              ->columnSpan(2),
            Components\TextEntry::make('town.name')
              ->label('Corregimiento'),
            Components\TextEntry::make('city.name')
              ->label('Distrito'),
            Components\TextEntry::make('state.name')
              ->label('Provincia'),
            Components\TextEntry::make('address')
              ->label('Dirección')
              ->columnSpanFull(),
            Components\TextEntry::make('description')
              ->label('Observación')
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
      'index' => Pages\ListCertificates::route('/'),
      'create' => Pages\CreateCertificate::route('/create'),
      'edit' => Pages\EditCertificate::route('/{record}/edit'),
      'view' => Pages\ViewCertificate::route('/{record}'),
    ];
  }
}
