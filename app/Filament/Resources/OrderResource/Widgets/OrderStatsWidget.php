<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Total Orders", Order::count()),
            Stat::make('New orders', Order::whereIn('status', ['Processing', 'New'])->count()),
            // Stat::make('Average price', number_format(Order::avg('ammount'), 2)),
        ];
    }
}
