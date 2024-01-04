<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                ->schema([
                    TextInput::make('name')
                        ->translateLabel()
                        ->required()
                        ->minLength(3)
                        ->maxLength(255),

                    TextInput::make('discount')
                        ->required()
                        ->label(__('Coupon Discount (%)'))
                        ->numeric(),

                    DatePicker::make('validity')
                        ->required()
                        ->minDate(now())
                        ->label(__('Coupon Validity Date'))
                        ->native(false)
                        ->format('d/m/y')
                        ->prefix('Ends at')
                        ->displayFormat('d/m/yy'),

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

                TextColumn::make('discount')
                    ->prefix('%')
                    ->translateLabel(),

                TextColumn::make('validity')
                    ->sortable()
                    ->translateLabel(),

                TextColumn::make('status')
                    ->sortable()
                    ->translateLabel()
                    ->state(function (Coupon $record): string {
                        if($record->validity >= Carbon::now()->format('d/m/y')) {
                            return 'Valid';
                        }else{
                            return 'Invalid';
                        }
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Valid' => 'success',
                        'Invalid' => 'danger',
                    }),

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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string{
        return __('Coupon');
    }

    public static function getPluralModelLabel(): string{
        return __('Coupons');
    }
}
