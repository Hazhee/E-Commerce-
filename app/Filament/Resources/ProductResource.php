<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
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

   

    public static function getNavigationBadge (): ?string{

        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('Name'))
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
                                    ->translateLabel()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Product::class, 'slug', ignoreRecord: true),

                                MarkdownEditor::make('short_desc')
                                    ->label(__('Short Description'))
                                    ->required()
                                    ->minLength(5)
                                    ->maxLength(255)
                                    ->columnSpan('full'),

                                MarkdownEditor::make('long_desc')
                                    ->label(__('Long Description'))
                                    ->required()
                                    ->minLength(5)
                                    ->columnSpan('full'),
                            ])
                            ->collapsible()
                            ->columns(2),

                        Section::make(__('Images'))
                            
                            ->schema([
                                FileUpload::make('thambnail')
                                    ->image()
                                    // ->multiple()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('1:1')
                                    ->imageResizeTargetWidth('800')
                                    ->imageResizeTargetHeight('800')
                                    ->label(__('Image'))
                                    ->directory('images'),

                                // FileUpload::make('product.multiImages')
                                //     ->image()
                                //     ->multiple()
                                //     ->imageResizeMode('cover')
                                //     ->imageCropAspectRatio('1:1')
                                //     ->imageResizeTargetWidth('1080')
                                //     ->imageResizeTargetHeight('1080')
                                //     ->label(__('Multi Images'))
                                //     ->directory('images'),
                            ])
                            ->collapsible(),

                        Section::make(__('Pricing'))
                            ->schema([
                                TextInput::make('price')
                                    ->numeric()
                                    ->translateLabel()
                                    ->required(),

                                TextInput::make('discount_price')
                                    ->label(__('Discount Price'))
                                    ->numeric(),

                            ])
                            ->columns(2),
                        Section::make(__('Inventory'))
                            ->schema([

                                TextInput::make('code')
                                    ->label(__('Barcode'))
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                TextInput::make('qty')
                                    ->label(__('Quantity'))
                                    ->required()
                                    ->numeric()
                                    ->rules(['integer', 'min:0']),

                            ])
                            ->columns(2),

                        Section::make(__('Offers'))
                            ->schema([
                                Checkbox::make('hot_deals')
                                    ->label(__('Hot Deals')),

                                Checkbox::make('featured')
                                    ->translateLabel(),

                                Checkbox::make('special_offer')
                                    ->label(__('Special Offer')),

                                Checkbox::make('special_deals')
                                    ->label(__('Special Deals')),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make(__('Details'))
                            ->schema([
                                Toggle::make('status')
                                    ->label(__('is visible')),

                                TagsInput::make('color')
                                    ->required()
                                    ->translateLabel()
                                    ->suggestions([
                                        'Red',
                                        'Black',
                                        'Blue',
                                        'Yellow',
                                        'White',
                                        'Orange',
                                    ]),

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
                                    ])
                                    ->translateLabel(),

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
                                    ])
                                    ->translateLabel(),

                            ])->collapsible(),

                        Section::make(__('Associations'))
                            ->schema([
                                Select::make('brand_id')
                                    ->options(Brand::query()->pluck('name', 'id'))
                                    ->label(__('Brand'))
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Select::make('vender_id')
                                    ->options(User::role('Vendor')->pluck('name', 'id'))
                                    ->label(__('Vender'))
                                    ->searchable()
                                    ->preload(),

                                Select::make('category_id')
                                    // ->options(Category::query()->pluck('name','id'))
                                    ->relationship('category', 'name')
                                    ->live(onBlur: true)
                                    ->required()
                                    ->label(__('Categories'))
                                    ->searchable()

                                    ->preload(),
                                //->multiple(),

                                Select::make('sub_category_id')
                                    ->options(fn(Get $get): Collection => SubCategory::query()->where('category_id', $get('category_id'))->pluck('name', 'id'))
                                    ->label(__('Sub Categories'))
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
                    ->sortable()
                    ->translateLabel(),

                TextColumn::make('name')
                    ->sortable()
                    ->translateLabel()
                    ->searchable(),

                TextColumn::make('slug')
                    ->sortable()
                    ->translateLabel()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ImageColumn::make('thambnail')
                    ->square()
                    ->label(__('Image'))
                    ->toggleable(),

                TextColumn::make('brand.name')
                    ->sortable()
                    ->label(__('Brand'))
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('vendor.name')
                    ->sortable()
                    ->placeholder(__('Owner'))
                    ->label(__('Vender'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('price')
                    ->money()
                    ->translateLabel()
                    ->toggleable(),

                TextColumn::make('discount_price')
                    ->state(function (Product $record): string {
                        if ($record->discount_price != null) {
                            $amount = $record->price - $record->discount_price;
                            return round(($amount / $record->price) * 100) . ' %';
                        }
                        return '0 %';
                    })
                    ->label(__('Discount'))
                    ->placeholder('No Discount')
                    ->toggleable(),

                TextColumn::make('qty')
                    ->label(__('Quantity'))
                    ->toggleable(),

                ColorColumn::make('color')
                    ->translateLabel()
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('status')
                    ->translateLabel()
                    // ->boolean()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('tags')
                    ->badge()
                    ->translateLabel()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('size')
                    ->badge()
                    ->translateLabel()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('category.name')
                    ->badge()
                    ->label(__('Category'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('category.subCategories.name')
                    ->badge()
                    ->label(__('Sub Categories'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->sortable()
                    ->translateLabel()
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


    public static function getModelLabel(): string{
        return __('Product');
    }

    public static function getPluralModelLabel(): string{
        return __('Products');
    }
}
