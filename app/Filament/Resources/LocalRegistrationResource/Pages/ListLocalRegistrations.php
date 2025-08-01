<?php

namespace App\Filament\Resources\LocalRegistrationResource\Pages;

use App\Filament\Resources\LocalRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLocalRegistrations extends ListRecords
{
    protected static string $resource = LocalRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
