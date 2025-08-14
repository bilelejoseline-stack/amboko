<?php

namespace App\Filament\Resources\MilitaireResource\Pages;

use App\Filament\Resources\MilitaireResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMilitaire extends EditRecord
{
    protected static string $resource = MilitaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
