<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Widgets\UserStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserStatsWidget::class,
        ];
    }


    public function getTabs(): array{
        return [
            'All' => Tab::make(),
            'Admins' => Tab::make()->query(fn ($query) => $query->role('Admin')),
            'Vendors' => Tab::make()->query(fn ($query) => $query->role('Vendor')),
            'Customers' => Tab::make()->query(fn ($query) => $query->role('Customer')),
           
        ];
    }
}
