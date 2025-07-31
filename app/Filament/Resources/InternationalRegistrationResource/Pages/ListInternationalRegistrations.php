<?php

namespace App\Filament\Resources\InternationalRegistrationResource\Pages;

use App\Filament\Resources\InternationalRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInternationalRegistrations extends ListRecords
{
    protected static string $resource = InternationalRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
