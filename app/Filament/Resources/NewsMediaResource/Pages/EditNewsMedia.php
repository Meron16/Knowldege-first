<?php

namespace App\Filament\Resources\NewsMediaResource\Pages;

use App\Filament\Resources\NewsMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsMedia extends EditRecord
{
    protected static string $resource = NewsMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
