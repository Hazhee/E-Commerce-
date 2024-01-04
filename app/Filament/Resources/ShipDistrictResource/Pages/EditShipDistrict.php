<?php

namespace App\Filament\Resources\ShipDistrictResource\Pages;

use App\Filament\Resources\ShipDistrictResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShipDistrict extends EditRecord
{
    protected static string $resource = ShipDistrictResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
