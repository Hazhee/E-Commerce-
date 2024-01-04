<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Filament\Tables\Actions\Action;








class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function getNavigationBadge (): ?string{

        return static::getModel()::where('status', 'New')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make(__('Order Details'))
                        ->schema([
                            Section::make(__('Order Details'))
                                ->schema([
                                    TextInput::make('order_number')
                                        ->label(__('Number'))
                                        ->unique(ignoreRecord: true)
                                        ->default('OR-' . random_int(100000, 999999))
                                        ->disabled()
                                        ->dehydrated()
                                        ->required(),

                                    TextInput::make('invoice_number')
                                        // ->visible(false)
                                        ->translateLabel()
                                        ->unique(ignoreRecord: true)
                                        ->default('INV-' . random_int(100000, 999999))
                                        ->disabled()
                                        ->dehydrated()
                                        ->required(),

                                    TextInput::make('name')
                                        // ->visible(false)
                                        ->label(__('Name'))
                                        ->default(User::role('Customer')->pluck('name'))
                                        ->disabled()
                                        ->dehydrated()
                                        ->required(),

                                    TextInput::make('email')
                                        // ->visible(false)
                                        ->translateLabel()
                                        ->default(User::role('Customer')->pluck('email'))
                                        ->disabled()
                                        ->dehydrated()
                                        ->required(),

                                    Select::make('user_id')
                                        ->options(User::role('Customer')->pluck('name', 'id'))
                                        ->label(__('Customer'))
                                        ->searchable()
                                        ->preload()
                                        ->native(false)
                                        ->required(),

                                    Select::make('ship_division_id')
                                        ->label(__('Division'))
                                        ->live(onBlur: true)
                                        ->options(ShipDivision::all()->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->native(false),

                                    Select::make('ship_district_id')
                                        ->label(__('District'))
                                        ->live(onBlur: true)
                                        ->options(fn(Get $get): Collection => ShipDistrict::query()->where('ship_division_id', $get('ship_division_id'))->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->native(false),

                                    Select::make('ship_state_id')
                                        ->label(__('State'))
                                        ->options(fn(Get $get): Collection => ShipState::query()->where('ship_district_id', $get('ship_district_id'))->pluck('name', 'id'))
                                        ->searchable()
                                        ->preload()
                                        ->native(false),

                                    TextInput::make('post_code')
                                        ->label(__('Postal Code'))
                                        ->minLength(3)
                                        ->maxLength(255),

                                    Select::make('currency')
                                        ->translateLabel()
                                        ->options([
                                            'USD' => 'USD',
                                            'IQD' => 'IQD',
                                            'ERU' => 'ERU',
                                        ])
                                        ->searchable()
                                        ->preload()
                                        ->native(false),

                                    TextInput::make('address')
                                        ->required()
                                        ->translateLabel()
                                        ->minLength(3)
                                        ->maxLength(255)
                                        ->columnSpanFull(),

                                    Select::make('status')
                                        ->translateLabel()
                                        ->options([
                                            'Processing' => 'Processing',
                                            'Pending' => 'Pending',
                                            'Shipped' => 'Shipped',
                                            'Delivered' => 'Delivered',
                                            'Picked Up' => 'Picked Up',
                                            'Confirmed' => 'Confirmed',
                                            'Canceled' => 'Canceled',
                                        ])
                                        ->searchable()
                                        ->required()
                                        ->preload()
                                        ->native(false),

                                    TextInput::make('phone')
                                        ->required()
                                        ->translateLabel()
                                        ->tel(),

                                    Radio::make('payment_type')
                                        ->label(__('Payment Type'))
                                        ->options([
                                            'Cash on delivery' => 'Cash on delivery',
                                            'master card' => 'master card',
                                            'visa card' => 'visa card'
                                        ]),

                                    MarkdownEditor::make('note')
                                        ->translateLabel()
                                        ->columnSpan('full'),

                                ])->columns(2)
                        ]),

                    Step::make(__('Order Items'))
                        ->schema([
                            Repeater::make('products')
                                ->relationship()
                                ->schema([
                                    Select::make('vender_id')
                                        ->label('Vendor')
                                        ->label(__('Vender'))
                                        ->native(false)
                                        ->live(onBlur: true)
                                        ->required()
                                        ->options(User::role('Vendor')->pluck('name', 'id'))
                                        ->afterStateUpdated(fn(callable $set) => $set('product_id', null)),

                                    Select::make('product_id')
                                        ->label(__('Product'))
                                        ->live(onBlur: true)
                                        ->reactive()
                                        // ->relationship('products')
                                        ->options(function (callable $get) {
                                            $vender = User::find($get('vender_id'));

                                            if (!$vender) {
                                                return Product::all()->pluck('name', 'id');
                                            }
                                            return Product::all()->where('vender_id', $vender->id)->pluck('name', 'id');
                                        })
                                        ->searchable()
                                        ->afterStateUpdated(fn($state, Forms\Set $set) => $set('price', Product::find($state)?->price ?? 0))
                                        ->preload()
                                        ->required(),

                                    

                                    TextInput::make('qty')
                                        ->required()
                                        ->label(__('Quantity'))
                                        ->live()
                                        ->dehydrated()
                                        ->default(1)
                                        ->minValue(1)
                                        ->numeric(),

                                    Select::make('color')
                                        ->required()
                                        ->translateLabel()
                                        ->native(false)
                                        ->searchable()
                                        ->options(function (callable $get) {
                                            $product = Product::find($get('product_id'));

                                            if (!$product) {
                                                return Product::all()->pluck('color','id');
                                            }
                                            return Product::all()->where('id', $product->id)->pluck('color','id');

                                        })

                                        // ->options(fn (Get $get): Collection => Product::query()->where('id', $get('products'))->pluck('color'))
                                        ->preload(),

                                    Select::make('size')
                                        ->required()
                                        ->translateLabel()
                                        ->native(false)
                                        ->searchable()
                                        ->options(function (Get $get) {
                                            $product = Product::find($get('product_id'));

                                            if (!$product) {
                                                return Product::query()->pluck('size','id');
                                            }
                                            return Product::where('id', $product->id)->pluck('size','id')->toArray();

                                        })
                                        // ->options(fn (Get $get): Collection => Product::query()->where('id', $get('products'))->pluck('size'))
                                        ->preload(),

                                    TextInput::make('price')
                                        ->required()
                                        ->translateLabel()
                                        ->dehydrated()
                                        ->disabled(),

                                    Placeholder::make('ammount')
                                        ->label(__('Total Price'))
                                        ->translateLabel()
                                        ->content(function ($get){
                                            return $get('qty') * $get('price');
                                        })
                                ])->columns(3),
                        ]),

                ])->columnSpanFull()








            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label(__('Number'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('customer.name')
                    ->sortable()
                    ->label(__('Customer'))
                    ->toggleable()
                    ->searchable(),
                
                TextColumn::make('status')
                    ->badge()
                    ->translateLabel()
                    ->color(fn (string $state): string => match ($state) {
                        'Processing' => 'warning',
                        'Pending' => 'warning',
                        'Shipped' => 'success',
                        'Delivered' => 'success',
                        'Picked Up' => 'success',
                        'Confirmed' => 'success',
                        'Canceled' => 'danger',
                    }),

                SelectColumn::make('status')
                
                    ->options([
                        'Processing' => 'Processing',
                        'Pending' => 'Pending',
                        'Shipped' => 'Shipped',
                        'Delivered' => 'Delivered',
                        'Picked Up' => 'Picked Up',
                        'Confirmed' => 'Confirmed',
                        'Canceled' => 'Canceled',
                    ]),

                TextColumn::make('currency')
                    ->sortable()
                    ->translateLabel()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('ammount')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->money(),

                TextColumn::make('order_date')
                    ->toggleable()
                    ->translateLabel()
                    ->date(),

                

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Action::make('Invoice')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->url(fn (Order $record)=> route('order.pdf.download', $record))
                    ->openUrlInNewTab()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Split::make([
                \Filament\Infolists\Components\Section::make(__('Order Details'))
                ->schema([
                    TextEntry::make('order_number'),

                    TextEntry::make('invoice_number')
                        ->translateLabel()
                        ->columnSpan(2),

                    TextEntry::make('name')
                        ->label(__('Customer Name')),

                    TextEntry::make('email')
                        ->icon('heroicon-m-envelope')
                        ->iconColor('primary')
                        ->translateLabel(),

                    TextEntry::make('phone')
                        ->icon('heroicon-m-phone')
                        ->iconColor('primary'),

                    TextEntry::make('currency')
                        ->translateLabel(),

                    TextEntry::make('payment_type')
                        ->label(__('Payment Type'))
                        ->icon('heroicon-m-banknotes')
                        ->iconColor('primary'),

                    TextEntry::make('ammount')
                        ->label(__('Total order amount'))
                        ->money('USD'),

                    

                    TextEntry::make('note')
                        ->markdown()
                        ->columnSpan('full'),
                ])->columns(3),

                \Filament\Infolists\Components\Section::make([
                    TextEntry::make('order_date')
                        ->dateTime(),

                    TextEntry::make('status')
                        ->translateLabel()
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Processing' => 'info',
                            'Pending' => 'warning',
                            'Shipped' => 'primary',
                            'Delivered' => 'success',
                            'Picked Up' => 'success',
                            'Confirmed' => 'success',
                            'Canceled' => 'danger',
                        }),

                       
                        \Filament\Infolists\Components\Actions::make([
                            
                            \Filament\Infolists\Components\Actions\Action::make('confirm')
                                ->requiresConfirmation()
                                
                                ->action(function (Order $record){
                                    if($record->status == 'Canceled'){
                                        return;
                                    }
                                    $record->status = "Confirmed";
                                    $record->save();
                                }),

                            \Filament\Infolists\Components\Actions\Action::make('cancel')
                                ->color('danger')
                                ->action(function (Order $record){
                                    $record->status = "Canceled";
                                    $record->save();
                                })
                                ->requiresConfirmation(),
                        ]),
                            
                           
                ])->grow(false),
            ]),
           
            \Filament\Infolists\Components\Section::make(__('Shipping Details'))
                        ->schema([

                            TextEntry::make('division.name')
                            ->translateLabel(),
    
                            TextEntry::make('district.name')
                                ->translateLabel(),
        
                            TextEntry::make('state.name')
                                ->translateLabel(),

                            TextEntry::make('address')
                                ->translateLabel()
                                ->icon('heroicon-m-map-pin')
                                ->iconColor('primary'),
        
                            TextEntry::make('post_code')
                                ->label(__('Postal Code')),
                            ])->columns(3),
        
            \Filament\Infolists\Components\Section::make(__('Order Items'))
                ->schema([
                    RepeatableEntry::make('products')
                        ->schema([
                            TextEntry::make('product.vendor.name')
                                ->label(__('Vender')),
                            TextEntry::make('product.name'),

                            TextEntry::make('qty')
                                ->label(__('Quantity')),

                            TextEntry::make('color')
                                ->placeholder('.....'),

                            TextEntry::make('size')
                                ->placeholder('.....'),

                            TextEntry::make('price')
                                ->label(__('Unit Price'))
                                ->money('USD'),

                            TextEntry::make('Total Price')
                                ->translateLabel()
                                ->money('USD')
                                ->state(function (OrderProduct $record): float {
                                    return $record->qty * $record->price;
                                }),
                    ])->columns(3),
               

                ])
            
        ])->columns(1);
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }


    public static function getModelLabel(): string{
        return __('Order');
    }

    public static function getPluralModelLabel(): string{
        return __('Orders');
    }
}
