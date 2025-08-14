<?php

namespace App\Filament\Resources\SanteMilitaireResource\Pages;

use App\Filament\Resources\SanteMilitaireResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSanteMilitaire extends EditRecord
{
    protected static string $resource = SanteMilitaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
