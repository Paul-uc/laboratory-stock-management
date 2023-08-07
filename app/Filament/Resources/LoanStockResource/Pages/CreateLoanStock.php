<?php

namespace App\Filament\Resources\LoanStockResource\Pages;

use App\Filament\Resources\LoanStockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLoanStock extends CreateRecord
{
    protected static string $resource = LoanStockResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Loan Record Created';
    }
}
