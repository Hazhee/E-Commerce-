<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section;
use Illuminate\Support\Str;



class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationGroup = 'Shop';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->live()
                    ->translateLabel()
                    ->required()
                    ->minLength(3)
                    ->maxLength(30)
                    ->unique(ignoreRecord: true)
                    ->afterStateUpdated(function (string $operation, $state , Forms\Set $set){
                        if ($operation == 'edit') {
                            return;
                        }
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                ->required()
                ->translateLabel()
                ->unique(ignoreRecord: true)
                ->maxLength(150),

                FileUpload::make('image')
                ->image()
                ->translateLabel()
                ->directory('images')
                ->columnSpanFull(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->translateLabel()
                ->sortable(),

                TextColumn::make('name')
                ->sortable()
                ->translateLabel()
                ->searchable(),

                TextColumn::make('slug')
                ->searchable()
                ->translateLabel(),

                ImageColumn::make('image')
                ->circular()
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string{
        return __('Brand');
    }

    public static function getPluralModelLabel(): string{
        return __('Brands');
    }
}
