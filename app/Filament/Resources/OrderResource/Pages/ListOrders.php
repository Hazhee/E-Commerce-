<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStatsWidget::class,
        ];
    }

    public function getTabs(): array{
        return [
            'All' => Tab::make(),
            'New' => Tab::make()->query(fn ($query) => $query->where('status', 'New')),
            'Processing' => Tab::make()->query(fn ($query) => $query->where('status', 'Processing')),
            'Shipped' => Tab::make()->query(fn ($query) => $query->where('status', 'Shipped')),
            'Delivered' => Tab::make()->query(fn ($query) => $query->where('status', 'Delivered')),
            'Picked Up' => Tab::make()->query(fn ($query) => $query->where('status', 'Picked Up')),
            'Confirmed' => Tab::make()->query(fn ($query) => $query->where('status', 'Confirmed')),
            'Canceled' => Tab::make()->query(fn ($query) => $query->where('status', 'Canceled')),
        ];
    }
}
