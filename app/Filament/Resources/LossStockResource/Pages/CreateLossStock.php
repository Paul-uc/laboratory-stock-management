<?php

namespace App\Filament\Resources\LossStockResource\Pages;

use App\Filament\Resources\LossStockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLossStock extends CreateRecord
{
    protected static string $resource = LossStockResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Loss Record Created';
    }
}
