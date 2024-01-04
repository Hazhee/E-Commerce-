<?php

namespace App\Filament\Resources\ShipDistrictResource\Pages;

use App\Filament\Resources\ShipDistrictResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShipDistricts extends ListRecords
{
    protected static string $resource = ShipDistrictResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
