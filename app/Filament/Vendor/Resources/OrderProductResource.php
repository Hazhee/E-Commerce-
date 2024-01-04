<?php

namespace App\Filament\Vendor\Resources;

use App\Filament\Vendor\Resources\OrderProductResource\Pages;
use App\Filament\Vendor\Resources\OrderProductResource\RelationManagers;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Illuminate\Support\Collection;


class OrderProductResource extends Resource
{
    protected static ?string $model = OrderProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            


        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('order.order_number')
                ->label(__('Number'))
                ->sortable()
                ->searchable(),

            TextColumn::make('order.name')
                ->sortable()
                ->label(__('Customer'))
                ->toggleable()
                ->searchable(),
            

            SelectColumn::make('order.status')
                ->label(__('Status'))
                ->options([
                    'Processing' => 'Processing',
                    'Pending' => 'Pending',
                    'Shipped' => 'Shipped',
                    'Delivered' => 'Delivered',
                    'Picked Up' => 'Picked Up',
                    'Confirmed' => 'Confirmed',
                    'Canceled' => 'Canceled',
                ]),

            TextColumn::make('order.currency')
                ->sortable()
                ->label(__('Currency'))
                ->toggleable()
                ->searchable(),

            TextColumn::make('order.ammount')
                ->sortable()
                ->prefix('$')
                ->label(__('Amount'))
                ->toggleable()
                ->searchable(),

            TextColumn::make('order.order_date')
                ->toggleable()
                ->label(__('Order Date'))
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
                    ->url(fn (OrderProduct $record)=> route('order.pdf.download', $record))
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
                    TextEntry::make('order.order_number')
                        ->label(__('Order Numbe')),

                    TextEntry::make('order.invoice_number')
                        ->label(__('Invoice Number'))
                        ->columnSpan(2),

                    TextEntry::make('order.name')
                        ->label(__('Customer Name')),

                    TextEntry::make('order.email')
                        ->icon('heroicon-m-envelope')
                        ->iconColor('primary')
                        ->label(__('Customer Email')),

                    TextEntry::make('order.phone')
                        ->label(__('Customer Phone'))
                        ->icon('heroicon-m-phone')
                        ->iconColor('primary'),

                    TextEntry::make('order.currency')
                        ->label(__('Currency')),

                    TextEntry::make('order.payment_type')
                        ->label(__('Payment Type'))
                        ->icon('heroicon-m-banknotes')
                        ->iconColor('primary'),
                    

                    TextEntry::make('order.note')
                        ->markdown()
                        ->label(__('Order Note'))
                        ->columnSpan('full'),
                ])->columns(3),

                \Filament\Infolists\Components\Section::make([
                    TextEntry::make('order.order_date')
                        ->label(__('Order Date'))
                        ->dateTime(),

                    TextEntry::make('order.status')
                        ->label(__('Order Status'))
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

                TextEntry::make('order.division.name')
                    ->label(__('Division')),

                TextEntry::make('order.district.name')
                    ->label(__('District')),

                TextEntry::make('order.state.name')
                    ->label(__('State')),

                TextEntry::make('order.address')
                    ->label(__('Address'))
                    ->icon('heroicon-m-map-pin')
                    ->iconColor('primary'),

                TextEntry::make('order.post_code')
                    ->label(__('Postal Code')),
                ])->columns(3),

                \Filament\Infolists\Components\Section::make(__('Order Items'))
                ->schema([
                    RepeatableEntry::make('order.products')
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
            'index' => Pages\ListOrderProducts::route('/'),
            'create' => Pages\CreateOrderProduct::route('/create'),
            'edit' => Pages\EditOrderProduct::route('/{record}/edit'),
            'view' => Pages\ViewOrderProduct::route('/{record}'),
        ];
    }

    public static function getModelLabel(): string{
        return __('Order');
    }

    public static function getPluralModelLabel(): string{
        return __('Orders');
    }
}
