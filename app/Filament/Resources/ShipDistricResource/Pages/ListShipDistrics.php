<?php

namespace App\Filament\Resources\ShipDistricResource\Pages;

use App\Filament\Resources\ShipDistricResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShipDistrics extends ListRecords
{
    protected static string $resource = ShipDistricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
