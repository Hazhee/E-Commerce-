<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipDistrictResource\Pages;
use App\Filament\Resources\ShipDistrictResource\RelationManagers;
use App\Models\ShipDistrict;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShipDistrictResource extends Resource
{
    protected static ?string $model = ShipDistrict::class;

    protected static ?string $navigationGroup = 'Shipping Area';

    // protected static ?string $navigationLabel = 'Districts';

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

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
                    Select::make('ship_division_id')
                        ->relationship('division', 'name')
                        ->native(false)
                        ->preload()
                        ->searchable(),
                ])->columns(2)
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

                TextColumn::make('division.name')
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
            'index' => Pages\ListShipDistricts::route('/'),
            'create' => Pages\CreateShipDistrict::route('/create'),
            'edit' => Pages\EditShipDistrict::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string{
        return __('Ship District');
    }

    public static function getPluralModelLabel(): string{
        return __('Ship Districts');
    }
}
