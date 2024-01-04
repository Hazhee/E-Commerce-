<?php

namespace App\Filament\Vendor\Resources\OrderProductResource\Pages;

use App\Filament\Vendor\Resources\OrderProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderProduct extends EditRecord
{
    protected static string $resource = OrderProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
