<?php

namespace App\Filament\Resources\StockResource\Pages;

use App\Filament\Resources\StockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStock extends EditRecord
{
    protected static string $resource = StockResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
