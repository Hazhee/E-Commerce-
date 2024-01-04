<?php

namespace App\Filament\Resources\ShipDivisionResource\Pages;

use App\Filament\Resources\ShipDivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShipDivisions extends ListRecords
{
    protected static string $resource = ShipDivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
