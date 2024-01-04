<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends BaseWidget
{

    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        return [
            Stat::make("Total Customers", User::role('Customer')->count())
                ->description('Increase in Customers')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 6, 9, 10, 20, 40, 45]),
            Stat::make("Total Products", Product::count()),
            Stat::make("New Orders", Order::whereIn('status', ['New', 'Processing'])->count())
                ->description('Total Products')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([5, 10, 15, 20, 25, 30, 35]),
        ];
    }
}
