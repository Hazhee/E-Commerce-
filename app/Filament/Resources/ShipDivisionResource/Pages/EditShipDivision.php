<?php

namespace App\Filament\Resources\ShipDivisionResource\Pages;

use App\Filament\Resources\ShipDivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShipDivision extends EditRecord
{
    protected static string $resource = ShipDivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
