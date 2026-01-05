<?php

namespace App\Filament\Resources\PosAnggarans\Pages;

use App\Filament\Resources\PosAnggarans\PosAnggaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPosAnggarans extends ListRecords
{
    protected static string $resource = PosAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
