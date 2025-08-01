<?php

namespace App\Filament\Resources\NewsMediaResource\Pages;

use App\Filament\Resources\NewsMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsMedia extends ListRecords
{
    protected static string $resource = NewsMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
        ];
    }
}
