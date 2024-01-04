<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
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
use Illuminate\Support\Str;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationGroup = 'Shop';
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Category'))
                ->schema([
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->live(onBlur: true)
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->minLength(3)
                        ->maxLength(255)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation !== 'create') {
                                return;
                            }

                            $set('slug', Str::slug($state));
                        }),
                    
                        TextInput::make('slug')
                            ->disabled()
                            ->translateLabel()
                            ->dehydrated()
                            ->required()
                            ->unique(Category::class, 'slug', ignoreRecord: true),

                    FileUpload::make('image')
                        ->translateLabel()
                        ->directory('images')
                        ->required()
                        ->image()
                        ->imageResizeMode('contain')
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('120')
                        ->imageResizeTargetHeight('120')
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
                TextColumn::make('name')
                    ->searchable()
                    ->translateLabel()
                    ->sortable(),

                TextColumn::make('slug')
                    ->sortable()
                    ->translateLabel()
                    ->searchable(),

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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string{
        return __('Category');
    }

    public static function getPluralModelLabel(): string{
        return __('Categories');
    }
}
