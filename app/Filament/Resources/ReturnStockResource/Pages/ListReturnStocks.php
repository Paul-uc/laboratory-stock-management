<?php

namespace App\Filament\Resources\ReturnStockResource\Pages;

use App\Filament\Resources\ReturnStockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReturnStocks extends ListRecords
{
    protected static string $resource = ReturnStockResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
