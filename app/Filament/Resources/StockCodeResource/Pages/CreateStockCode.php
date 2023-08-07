<?php

namespace App\Filament\Resources\StockCodeResource\Pages;

use App\Filament\Resources\StockCodeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStockCode extends CreateRecord
{
    protected static string $resource = StockCodeResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Stock Code Created';
    }
}
