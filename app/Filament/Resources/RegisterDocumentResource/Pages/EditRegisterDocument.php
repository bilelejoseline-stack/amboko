<?php

namespace App\Filament\Resources\RegisterDocumentResource\Pages;

use App\Filament\Resources\RegisterDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegisterDocument extends EditRecord
{
    protected static string $resource = RegisterDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
