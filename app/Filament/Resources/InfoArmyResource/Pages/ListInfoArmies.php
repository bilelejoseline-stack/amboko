<?php

namespace App\Filament\Resources\InfoArmyResource\Pages;

use App\Filament\Resources\InfoArmyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfoArmies extends ListRecords
{
    protected static string $resource = InfoArmyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
