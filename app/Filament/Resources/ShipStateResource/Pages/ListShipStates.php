<?php

namespace App\Filament\Resources\ShipStateResource\Pages;

use App\Filament\Resources\ShipStateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShipStates extends ListRecords
{
    protected static string $resource = ShipStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
