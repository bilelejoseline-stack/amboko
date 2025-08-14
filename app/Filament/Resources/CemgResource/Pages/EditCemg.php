<?php

namespace App\Filament\Resources\CemgResource\Pages;

use App\Filament\Resources\CemgResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCemg extends EditRecord
{
    protected static string $resource = CemgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
