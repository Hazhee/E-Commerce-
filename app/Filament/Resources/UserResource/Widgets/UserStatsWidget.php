<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Total Customers", User::role('Customer')->count()),
            Stat::make("Total Vendors", User::role('Vendor')->count()),
            Stat::make("Total Admins", User::role('Admin')->count()),
        ];
    }
}
