<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipStateResource\Pages;
use App\Filament\Resources\ShipStateResource\RelationManagers;
use App\Models\ShipDistrict;
use App\Models\ShipState;
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
use Illuminate\Support\Collection;
use Filament\Forms\Get;

class ShipStateResource extends Resource
{
    protected static ?string $model = ShipState::class;

    protected static ?string $navigationGroup = 'Shipping Area';


    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

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
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Select::make('ship_division_id')
                        ->live(onBlur: true)
                        ->relationship('division', 'name')
                        ->native(false)
                        ->required()
                        ->searchable()
                        ->preload(),

                    Select::make('ship_district_id')
                        ->label('District')
                        ->options(fn ( Get $get): Collection => ShipDistrict::query()->where('ship_division_id', $get('ship_division_id'))->pluck('name', 'id')) 
                        ->native(false)
                        ->required()
                        ->searchable()
                        ->preload(),
                        
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
                TextColumn::make('district.name')
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
            'index' => Pages\ListShipStates::route('/'),
            'create' => Pages\CreateShipState::route('/create'),
            'edit' => Pages\EditShipState::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string{
        return __('Ship State');
    }

    public static function getPluralModelLabel(): string{
        return __('Ship States');
    }
}
