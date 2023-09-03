<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\lossStock;
use App\Models\Stock;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
          
            Stat::make('User Count', User::count())
                ->icon('heroicon-o-users')
                ->description('Total number of users')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor('success'),

            Stat::make('Stock Count', Stock::count())
                ->icon('heroicon-o-rectangle-stack')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor('success'),

            Stat::make('Loss Stock Count', lossStock::count())
                ->icon('heroicon-o-rectangle-stack')
                ->description('50% decrease')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->descriptionColor('danger'),
        ];
    }
}
