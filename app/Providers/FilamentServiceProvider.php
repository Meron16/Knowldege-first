<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationGroup;

class FilamentServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }


public function boot()
{
    Filament::serving(function () {
        Filament::registerNavigationGroups([
            NavigationGroup::make('User Management')->icon('heroicon-o-users'),
            // other groups...
        ]);

Filament::registerNavigationItems([
    NavigationItem::make('Logout')
        ->url(route('logout'))
        ->icon('heroicon-o-logout')
        ->color('danger')
        ->position('bottom'),
]);

    });
}
}