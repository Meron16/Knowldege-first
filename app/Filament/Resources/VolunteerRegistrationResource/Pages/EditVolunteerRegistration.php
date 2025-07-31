<?php

namespace App\Filament\Resources\VolunteerRegistrationResource\Pages;

use App\Filament\Resources\VolunteerRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVolunteerRegistration extends EditRecord
{
    protected static string $resource = VolunteerRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
