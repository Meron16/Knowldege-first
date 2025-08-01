<?php

namespace App\Filament\Resources\DomesticRegistrationResource\Pages;

use App\Filament\Resources\DomesticRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDomesticRegistrations extends ListRecords
{
    protected static string $resource = DomesticRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
