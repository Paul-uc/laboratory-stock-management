<?php

namespace App\Filament\Resources\StockCodeResource\Pages;

use App\Filament\Resources\StockCodeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockCodes extends ListRecords
{
    protected static string $resource = StockCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
