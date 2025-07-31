<?php

namespace App\Filament\Resources\VolunteerRegistrationResource\Pages;

use App\Filament\Resources\VolunteerRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVolunteerRegistrations extends ListRecords
{
    protected static string $resource = VolunteerRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
