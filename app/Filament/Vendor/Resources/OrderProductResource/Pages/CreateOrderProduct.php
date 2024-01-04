<?php

namespace App\Filament\Vendor\Resources\OrderProductResource\Pages;

use App\Filament\Vendor\Resources\OrderProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderProduct extends CreateRecord
{
    protected static string $resource = OrderProductResource::class;

    public function mutateFormDataBeforeCreate(array $data): array{
        $data['vender_id'] = auth()->user()->id;

        return $data;
    }
}
