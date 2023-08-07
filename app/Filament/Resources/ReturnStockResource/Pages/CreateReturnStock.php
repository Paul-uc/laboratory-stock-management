<?php

namespace App\Filament\Resources\ReturnStockResource\Pages;

use App\Filament\Resources\ReturnStockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReturnStock extends CreateRecord
{
    protected static string $resource = ReturnStockResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Return Record Created';
    }
}
