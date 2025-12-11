<?php

namespace App\Filament\Resources\JenisIurans\Pages;

use App\Filament\Resources\JenisIurans\JenisIuranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenisIurans extends ListRecords
{
    protected static string $resource = JenisIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
