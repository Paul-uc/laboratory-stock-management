<?php

namespace App\Filament\Resources\LoanStockResource\Pages;

use App\Filament\Resources\LoanStockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLoanStock extends EditRecord
{
    protected static string $resource = LoanStockResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
