<?php

namespace App\Filament\Resources\LossStockResource\Pages;

use App\Filament\Resources\LossStockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLossStocks extends ListRecords
{
    protected static string $resource = LossStockResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
