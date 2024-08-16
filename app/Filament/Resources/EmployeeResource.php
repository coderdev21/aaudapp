<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\City;
use App\Models\Employee;
use App\Models\Town;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Support\RawJs;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Collection;

class EmployeeResource extends Resource
{
  protected static ?string $model = Employee::class;
  protected static ?string $label = 'Funcionarios';
  protected static ?string $navigationIcon = 'fas-user-group';
  protected static ?string $navigationGroup = 'Configuración';
  protected static ?int $navigationSort = 3;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Datos Personales')
          ->description('Ingrese los datos personales del funcionario')
          ->schema([
            TextInput::make('nombre')
              ->label('Nombre')
              ->required()
              ->maxLength(255),
            TextInput::make('segundo_nombre')
              ->label('Segundo Nombre')
              ->maxLength(255),
            TextInput::make('apellido_paterno')
              ->label('Apellido Paterno')
              ->required()
              ->maxLength(255),
            TextInput::make('apellido_materno')
              ->label('Apellido Materno')
              ->maxLength(255),
            TextInput::make('cedula')
              ->label('Cédula')
              ->required()
              ->maxLength(255),
            TextInput::make('seguro_social')
              ->label('No. de Seguro Social')
              ->required()
              ->maxLength(255),
            DatePicker::make('fecha_nacimiento')
              ->required(),
            Radio::make('genero')
              ->label('Genero')
              ->options([
                false => 'Femenino',
                true => 'Masculino',
              ])
              ->default(false)
              ->inline()
              ->inlineLabel(false)
              ->columnSpan('2')
              ->required(),
            Radio::make('estado_civil')
              ->label('Estado Civil')
              ->options([
                false => 'Soltero',
                true => 'Casado',
              ])
              ->default(false)
              ->inline()
              ->inlineLabel(false)
              ->required(),
          ])->columns(4),
        Section::make('Dirección')
          ->description('Ingrese la dirección del funcionario')
          ->schema([
            Select::make('state_id')
              ->label('Provincia')
              ->relationship(name: 'state', titleAttribute: 'name')
              ->searchable()
              ->preload()
              ->live()
              ->native(false)
              ->required(),
            Select::make('city_id')
              ->label('Distrito')
              ->options(fn (Get $get): Collection => City::query()
                ->where('state_id', $get('state_id'))
                ->pluck('name', 'id'))
              ->live()
              ->preload()
              ->searchable()
              ->required(),
            Select::make('town_id')
              ->label('Corregimiento')
              ->options(fn (Get $get): Collection => Town::query()
                ->where('city_id', $get('city_id'))
                ->pluck('name', 'id'))
              ->live()
              ->preload()
              ->searchable()
              ->required(),
            TextInput::make('address')
              ->label('Dirección')
              ->required()
              ->maxLength(255)
              ->columnSpan('full'),
          ])->columns(3),
        Section::make('Datos de Contratacíon')
          ->description('Ingrese los datos de contratación del funcionario')
          ->schema([
            TextInput::make('employee_number')
              ->label('Numero de Funcionario')
              ->required(),
            Select::make('employee_type_id')
              ->label('Tipo de Empleado')
              ->relationship('employeeType', 'name')
              ->native(false)
              ->required(),
            Select::make('status')
              ->label('Status')
              ->options([
                'A' => 'Activo',
                'B' => 'De Baja',
                'LS' => 'Licencia Sin Sueldo',
                'LE' => 'Licencia por Enfermedad',
              ])
              ->native(false)
              ->required(),
            DatePicker::make('start')
              ->label('Fecha de Incio')
              ->required(),
            DatePicker::make('end')
              ->label('Fecha de Terminación')
              ->required(),
            Select::make('agency_id')
              ->label('Agencia')
              ->relationship(name: 'agency', titleAttribute: 'name')
              ->searchable()
              ->preload()
              ->required(),
            Select::make('department_id')
              ->label('Departamento')
              ->relationship(name: 'department', titleAttribute: 'name')
              ->searchable()
              ->preload()
              ->required()
              ->columnSpan(2),
            TextInput::make('numero_resolucion')
              ->label('No. de Resolución')
              ->required()
              ->maxLength(255)
              ->default(00000),
            TextInput::make('numero_contrato')
              ->label('No. de Contrato')
              ->required()
              ->maxLength(255)
              ->default(00000),
            TextInput::make('numero_posicion')
              ->label('Numero de Posición')
              ->required()
              ->maxLength(255),
            TextInput::make('objeto_gasto')
              ->label('Objeto Gasto')
              ->required()
              ->maxLength(255)
              ->default(0),
            TextInput::make('numero_planilla')
              ->label('No. de Planilla')
              ->required()
              ->maxLength(255)
              ->default(0),
            TextInput::make('numero_partida')
              ->label('No. de Partida')
              ->required()
              ->maxLength(255)
              ->default(0),
            TextInput::make('salary')
              ->label('Salario')
              ->mask(RawJs::make('$money($input)'))
              ->stripCharacters(',')
              ->numeric()
              ->required(),
            //->default(0),
            TextInput::make('gastos_representacion')
              ->label('Gastos de Representación')
              ->required()
              ->numeric()
              ->default(0),
            TextInput::make('numero_partida_gasto_representacion')
              ->label('No. Partida / Gastos de Rep.')
              ->required()
              ->maxLength(255)
              ->default(0)
          ])->columns(4),
        Section::make('Información Bancaria')
          ->description('Ingrese los datos para el pago del salario por ACH del funcionario')
          ->headerActions([
            Action::make('test')
              ->action(function () {
                // ...
              }),
          ])
          ->schema([
            Select::make('bank_id')
              ->label('Banco')
              ->relationship(name: 'bank', titleAttribute: 'name')
              ->searchable(),
            Select::make('tipo_cuenta')
              ->label('Tipo de Cuenta')
              ->options([
                'S' => 'Ahorro',
                'C' => 'Corriente',
              ])
              ->native(false),
            TextInput::make('accout_number')
              ->label('Nuemero de Cuenta')
              ->maxLength(15),
            TextInput::make('tipo_cuenta_beneficiario')
              ->label('Tipo de cuenta beneficiario')
              ->maxLength(255),
            TextInput::make('card_type')
              ->label('Tipo de Tarjeta')
              ->maxLength(255),
          ])->columns(4),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('numero_posicion')
          ->label('No. de Posición')
          ->searchable(),
        TextColumn::make('fullname')
          ->label('Nombre Completo')
          ->searchable(),
        TextColumn::make('cedula')
          ->label('Cédula')
          ->searchable(),
        TextColumn::make('employee_type')
          ->label('Tipo de Empleado'),
        TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('updated_at')
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
      'index' => Pages\ListEmployees::route('/'),
      'create' => Pages\CreateEmployee::route('/create'),
      'edit' => Pages\EditEmployee::route('/{record}/edit'),
    ];
  }
}
