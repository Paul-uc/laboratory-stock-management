<?php

namespace App\Filament\Resources\LossStockResource\Pages;

use App\Filament\Resources\LossStockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLossStock extends EditRecord
{
    protected static string $resource = LossStockResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
