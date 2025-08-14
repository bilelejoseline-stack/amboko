<?php

namespace App\Filament\Resources\RoleCemgResource\Pages;

use App\Filament\Resources\RoleCemgResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoleCemg extends EditRecord
{
    protected static string $resource = RoleCemgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
