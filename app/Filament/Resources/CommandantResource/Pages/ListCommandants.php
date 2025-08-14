<?php

namespace App\Filament\Resources\CommandantResource\Pages;

use App\Filament\Resources\CommandantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommandants extends ListRecords
{
    protected static string $resource = CommandantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
