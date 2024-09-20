<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AssetResource extends Resource
{
  protected static ?string $model = Asset::class;
  protected static ?string $navigationGroup = 'Informática';
  protected static ?string $pluralModelLabel = 'Equipos';
  protected static ?string $navigationLabel = 'Equipos';
  protected static ?string $modelLabel = 'Equipo';
  protected static ?string $navigationIcon = 'fas-computer';
  protected static ?int $navigationSort = 3;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make([
          Split::make([
            Section::make('Datos del Equipo Informático')
              ->description('Ingrese los datos del Equipo Informático para el inventario.')
              ->schema([
                Forms\Components\TextInput::make('marbete')
                  ->label('Marbete')
                  ->required()
                  ->maxLength(255),
                Forms\Components\Select::make('asset_type_id')
                  ->label('Clase de Equipo')
                  ->relationship('assetType', 'name')
                  ->native(false)
                  ->required(),
                Forms\Components\Select::make('brand_id')
                  ->label('Marca')
                  ->relationship('brand', 'name')
                  ->native(false)
                  ->required(),
                Forms\Components\Select::make('brand_modelo_id')
                  ->label('Modelo')
                  ->relationship('brandModelo', 'name')
                  ->native(false)
                  ->required(),
                Forms\Components\TextInput::make('serial')
                  ->label('No. de Serie')
                  ->required()
                  ->maxLength(255),
                Forms\Components\Select::make('condition_id')
                  ->label('Condición del Equipo')
                  ->relationship('condition', 'name')
                  ->native(false)
                  ->required(),
                Forms\Components\Textarea::make('description')
                  ->label('Descripción')
                  ->rows(5)
                  ->columnSpanFull()
              ])->columns(2),
            Section::make('Imagen del Equipo')
              ->description('Carge una imagen del equipo para mayor descripción.')
              ->schema([
                Forms\Components\FileUpload::make('image_url')
                  ->image()
                  ->hiddenLabel()
                  ->imageCropAspectRatio('1:1')
                  ->imagePreviewHeight('300')
                  //->panelAspectRatio('1:1')
                  ->directory('images/employees')
                  ->uploadingMessage('Subiendo la imagen del equipo...'),
              ])->grow(false)
          ]),
          Section::make('Ubicación del Equipo')
            ->description('Ingrese los datos de la ubicación del equipo y el usaurio asignado.')
            ->schema([
              Forms\Components\Select::make('agency_id')
                ->label('Agencia')
                ->relationship('agency', 'name')
                ->native(false)
                ->preload()
                ->required(),
              Forms\Components\Select::make('department_id')
                ->label('Departamento')
                ->relationship('department', 'name')
                ->preload()
                ->searchable()
                ->required(),
              Forms\Components\Select::make('employee_id')
                ->label('Funcionario')
                ->relationship('employee', 'shortfullname')
                ->searchable()
                ->required(),
            ])->columns(3)
        ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('marbete')
          ->searchable(),
        Tables\Columns\TextColumn::make('brand.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('assetType.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('brandModelo.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('serial')
          ->searchable(),
        Tables\Columns\TextColumn::make('agency.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('department.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('employee.id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('condition.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\ImageColumn::make('image'),
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
      'index' => Pages\ListAssets::route('/'),
      'create' => Pages\CreateAsset::route('/create'),
      'edit' => Pages\EditAsset::route('/{record}/edit'),
    ];
  }
}
