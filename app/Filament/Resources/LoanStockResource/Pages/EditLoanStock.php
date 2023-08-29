<?php

namespace App\Filament\Resources\LoanStockResource\Pages;

use App\Filament\Resources\LoanStockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLoanStock extends EditRecord
{
    protected static string $resource = LoanStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Loan Record Updated';
    }
}
