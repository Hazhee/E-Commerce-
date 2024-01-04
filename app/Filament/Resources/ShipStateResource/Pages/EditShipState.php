<?php

namespace App\Filament\Resources\ShipStateResource\Pages;

use App\Filament\Resources\ShipStateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShipState extends EditRecord
{
    protected static string $resource = ShipStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
