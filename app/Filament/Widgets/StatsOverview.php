<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\Newsletter;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
   protected function getStats(): array
{
    return [
        Stat::make('Total subscribers', Newsletter::count())
        ->description('Increase is subscriptions')
        ->descriptionIcon('heroicon-m-arrow-trending-up')
        ->color('success')
        ->chart([7,3,4,5,6,3,5,3]),
        Stat::make('Total Contact', Contact::count())
        ->description('Increase is contacts')
        ->descriptionIcon('heroicon-m-arrow-trending-up')
        ->color('success')
        ->chart([7,3,4,5,6,3,5,3]),
    ];
}

}
