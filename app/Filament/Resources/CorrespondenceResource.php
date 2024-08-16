<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorrespondenceResource\Pages;
use App\Filament\Resources\CorrespondenceResource\RelationManagers;
use App\Models\Correspondence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class CorrespondenceResource extends Resource
{
    protected static ?string $model = Correspondence::class;
    protected static ?string $label = 'Correspondencia';
    protected static ?string $navigationIcon = 'fas-envelope-open-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\DateTimePicker::make('date_received')
                            ->label('Fecha de Recibido')
                            ->required(),
                        Forms\Components\DateTimePicker::make('document_date')
                            ->label('Fecha del Documento')
                            ->required(),
                        Forms\Components\TextInput::make('document_number')
                            ->label('No. de Documento')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sender')
                            ->label('Remitente')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subject')
                            ->label('Asunto')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('correspondence_type_id')
                            ->label('Tipo de Corresponencia')
                            ->relationship('correspondenceType', 'name')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                        ->label('Archivado')
                            ->required()
                            ->default(false),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_received')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('document_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('document_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('correspondenceType.name')
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
            'index' => Pages\ListCorrespondences::route('/'),
            'create' => Pages\CreateCorrespondence::route('/create'),
            'edit' => Pages\EditCorrespondence::route('/{record}/edit'),
        ];
    }
}
