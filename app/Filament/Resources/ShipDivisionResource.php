<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipDivisionResource\Pages;
use App\Filament\Resources\ShipDivisionResource\RelationManagers;
use App\Models\ShipDivision;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShipDivisionResource extends Resource
{
    protected static ?string $model = ShipDivision::class;

    protected static ?string $navigationGroup = 'Shipping Area';


    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->minLength(3)
                        ->maxLength(255),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->translateLabel(),
                TextColumn::make('name')
                    ->searchable()
                    ->translateLabel()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListShipDivisions::route('/'),
            'create' => Pages\CreateShipDivision::route('/create'),
            'edit' => Pages\EditShipDivision::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string{
        return __('Ship Division');
    }

    public static function getPluralModelLabel(): string{
        return __('Ship Divisions');
    }
}
