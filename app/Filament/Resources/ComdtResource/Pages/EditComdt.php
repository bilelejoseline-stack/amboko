<?php

namespace App\Filament\Resources\ComdtResource\Pages;

use App\Filament\Resources\ComdtResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComdt extends EditRecord
{
    protected static string $resource = ComdtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
