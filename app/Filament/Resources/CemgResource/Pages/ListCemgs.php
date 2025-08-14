<?php

namespace App\Filament\Resources\CemgResource\Pages;

use App\Filament\Resources\CemgResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCemgs extends ListRecords
{
    protected static string $resource = CemgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
