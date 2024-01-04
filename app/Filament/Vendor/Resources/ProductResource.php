<?php

namespace App\Filament\Vendor\Resources;

use App\Filament\Vendor\Resources\ProductResource\Pages;
use App\Filament\Vendor\Resources\ProductResource\RelationManagers;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Filament\Forms\Get;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shop';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Group::make()
                ->schema([
                    Section::make()
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                    if ($operation !== 'create') {
                                        return;
                                    }

                                    $set('slug', Str::slug($state));
                                }),

                            TextInput::make('slug')
                                ->disabled()
                                ->dehydrated()
                                ->required()
                                ->unique(Product::class, 'slug', ignoreRecord: true),

                            MarkdownEditor::make('short_desc')
                                ->label('Short Description')
                                ->required()
                                ->minLength(5)
                                ->maxLength(255)
                                ->columnSpan('full'),

                            MarkdownEditor::make('long_desc')
                                ->label('Long Description')
                                ->required()
                                ->minLength(5)
                                ->columnSpan('full'),
                        ])
                        ->collapsible()
                        ->columns(2),

                    Section::make('Images')
                        ->schema([
                            FileUpload::make('thambnail')
                                ->image()
                                ->directory('images'),
                        ])
                        ->collapsible(),

                    Section::make('Pricing')
                        ->schema([
                            TextInput::make('price')
                                ->numeric()
                                ->required(),

                            TextInput::make('discount_price')
                                ->label('Discount Price')
                                ->numeric(),

                        ])
                        ->columns(2),
                    Section::make('Inventory')
                        ->schema([

                            TextInput::make('code')
                                ->label('Barcode')
                                ->required()
                                ->unique(ignoreRecord: true),

                            TextInput::make('qty')
                                ->label('Quantity')
                                ->required()
                                ->numeric()
                                ->rules(['integer', 'min:0']),

                        ])
                        ->columns(2),

                    Section::make('Offers')
                        ->schema([
                            Checkbox::make('hot_deals')
                                ->label('Hot Deals'),

                            Checkbox::make('featured'),

                            Checkbox::make('special_offer')
                                ->label('Special Offer'),

                            Checkbox::make('special_deals')
                                ->label('Special Deals'),
                        ])
                        ->columns(2),
                ])
                ->columnSpan(['lg' => 2]),

            Group::make()
                ->schema([
                    Section::make('Details')
                        ->schema([
                            Toggle::make('status')
                                ->label('is visible'),

                            ColorPicker::make('color')
                                ->required(),

                            TagsInput::make('size')
                                ->suggestions([
                                    'X Small',
                                    'small',
                                    'mediam',
                                    'large',
                                    'X Large',
                                    'XX Large',
                                ])
                                ->nestedRecursiveRules([
                                    'min:3',
                                    'max:255',
                                ]),

                            TagsInput::make('tags')
                                ->suggestions([
                                    'tailwindcss',
                                    'alpinejs',
                                    'laravel',
                                    'livewire',
                                ])
                                ->nestedRecursiveRules([
                                    'min:3',
                                    'max:255',
                                ]),

                        ])->collapsible(),

                    Section::make('Associations')
                        ->schema([
                            Select::make('brand_id')
                                ->options(Brand::query()->pluck('name','id'))
                                ->label('Brand')
                                ->required()
                                ->searchable()
                                ->preload(),

                            Select::make('vender_id')
                                // ->options(auth()->user()->pluck('name','id'))
                                ->default(auth()->user()->id)
                                ->visible(false)
                                ->required()
                                ->searchable()
                                ->preload(),
                                
                            Select::make('category_id')
                                ->relationship('category','name')
                                ->live(onBlur: true)
                                ->required()
                                ->label('Categories')
                                ->searchable()
                                ->preload(),
                                // ->multiple(),

                            Select::make('sub_category_id')
                                ->options(fn (Get $get): Collection => SubCategory::query()->where('category_id', $get('category_id'))->pluck('name', 'id'))
                                ->label('Sub Categories')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->multiple(),
                                
                        ])->collapsible(),
                ])
                ->columnSpan(['lg' => 1]),
        ])
        ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id')
                ->sortable(),

            TextColumn::make('name')
                ->sortable()
                ->searchable(),

            TextColumn::make('slug')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),

            ImageColumn::make('thambnail')
                ->square()
                ->toggleable(),

            TextColumn::make('brand.name')
                ->sortable()
                ->searchable()
                ->toggleable(),

            TextColumn::make('vendor.name')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('price')
                ->money()
                ->toggleable(),

            TextColumn::make('discount_price')
                ->state(function (Product $record): string {
                    if($record->discount_price != null){
                        $amount = $record->price - $record->discount_price ;
                        return round(($amount/ $record->price) * 100). ' %';
                    }
                    return '0 %';
                    
                })
                ->label('Discount')
                ->placeholder('No Discount')
                ->toggleable(),

            TextColumn::make('qty')
                ->label('Quantity')
                ->toggleable(),

            ToggleColumn::make('status')
                ->label('Visibility')
                // ->boolean()
                ->sortable()
                ->toggleable(),

            TextColumn::make('tags')
                ->badge()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('size')
                ->badge()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('category.name')
                ->badge()
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),

            TextColumn::make('category.subCategories.name')
                ->badge()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('created_at')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
