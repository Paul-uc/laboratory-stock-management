<?php

namespace App\Filament\Resources\StockCodeResource\Pages;

use App\Filament\Resources\StockCodeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStockCode extends EditRecord
{
    protected static string $resource = StockCodeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Stock Code Updated';
    }
}
