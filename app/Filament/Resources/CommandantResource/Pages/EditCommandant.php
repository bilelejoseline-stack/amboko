<?php

namespace App\Filament\Resources\CommandantResource\Pages;

use App\Filament\Resources\CommandantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommandant extends EditRecord
{
    protected static string $resource = CommandantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
