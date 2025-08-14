<?php

namespace App\Filament\Resources\RegisterDocumentResource\Pages;

use App\Filament\Resources\RegisterDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegisterDocuments extends ListRecords
{
    protected static string $resource = RegisterDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
