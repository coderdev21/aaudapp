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
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\App;

class CreateCertificateRecord extends CreateRecord
{
  protected static string $resource = CertificateResource::class;

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    // If needed, you can further manipulate the data here before saving.
    return $data;
  }
}

class CertificateResource extends Resource
{

  protected static ?string $model = Certificate::class;
  protected static ?string $label = 'Paz y Salvo';
  protected static ?string $navigationIcon = 'fas-file-invoice';
  protected static ?string $navigationGroup = 'Comercialización';
  protected static ?int $navigationSort = 2;

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
                $set('state', Customer::find($get('customer_id'))->state);
                $set('city', Customer::find($get('customer_id'))->city);
                $set('town', Customer::find($get('customer_id'))->town);
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
            Forms\Components\TextInput::make('state')
              ->label('Provincia:')
              ->required()
              ->disabled()
              ->dehydrated(),
            Forms\Components\TextInput::make('city')
              ->label('Distrito:')
              ->required()
              ->disabled()
              ->dehydrated(),
            Forms\Components\TextInput::make('town')
              ->label('Corregimiento:')
              ->required()
              ->disabled()
              ->dehydrated(),
            Forms\Components\TextInput::make('address')
              ->label('Dirección:')
              ->required()
              ->disabled()
              ->dehydrated()
              ->columnSpanFull(),
          ])->columns(3),
        Fieldset::make('Información de Comercialización')
          ->schema([
            Forms\Components\Hidden::make('control_number')
              ->dehydrated(),
            Forms\Components\TextInput::make('created_by')
              ->label('Elaborado por:')
              ->default(function () {
                $name = Auth::user()->employee->nombre . ' ' . Auth::user()->employee->apellido_paterno;
                return $name;
              })
              ->disabled()
              ->dehydrated(),
            Forms\Components\TextInput::make('agency')
              ->label('Agencia')
              ->default(Auth::check() ? Auth::user()->employee->agency->name : 'No user')
              ->disabled()
              ->dehydrated(),
            Forms\Components\Textarea::make('description')
              ->label('Observación')
              ->required()
              ->columnSpanFull(),
          ])->columns(4),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('created_at')
          ->label('Fecha')
          ->dateTime('Y-m-d')
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
        Tables\Columns\TextColumn::make('agency')
          ->label('Agencia')
          ->sortable(),
        Tables\Columns\TextColumn::make('created_by')
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
          ->label('Imprimir')
          ->icon('fas-file-invoice')
          ->url(
            fn($record): string => route('pdf.pazysalvo', ['id' => $record->id]),
            shouldOpenInNewTab: true
          ),
        //Tables\Actions\EditAction::make(),
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
      'index' => Pages\ListCertificates::route('/'),
      'create' => Pages\CreateCertificate::route('/create'),
      'edit' => Pages\EditCertificate::route('/{record}/edit'),
    ];
  }
}
