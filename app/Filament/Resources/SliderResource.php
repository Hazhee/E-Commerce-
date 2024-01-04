<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationGroup = 'Home';

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Slider'))
                    ->schema([
                        TextInput::make('title')
                            ->translateLabel()
                            ->required()
                            ->minLength(3)
                            ->maxLength(255),

                        TextInput::make('short_title')
                            ->translateLabel()
                            ->required()
                            ->minLength(3)
                            ->maxLength(255),

                        FileUpload::make('image')
                            ->translateLabel()
                            ->directory('images')
                            ->required()
                            ->image()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->translateLabel(), 

                TextColumn::make('title')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('short_title')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('image')
                    ->translateLabel(),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string{
        return __('Slider');
    }

    public static function getPluralModelLabel(): string{
        return __('Sliders');
    }
}
