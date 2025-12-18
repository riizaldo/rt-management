<?php

namespace App\Filament\Resources\JenisPengeluarans\Pages;

use App\Filament\Resources\JenisPengeluarans\JenisPengeluaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenisPengeluarans extends ListRecords
{
    protected static string $resource = JenisPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
