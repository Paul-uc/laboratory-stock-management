<?php

namespace App\Filament\Resources\ApprovalResource\Pages;

use App\Filament\Resources\ApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQrCode extends ViewRecord
{
    protected static string $resource = ApprovalResource::class;

    protected static string $view = 'viewQRcode.index';

    protected function getActions(): array
    {
        return [];
    }
}
