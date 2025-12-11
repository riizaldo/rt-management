<?php

namespace App\Filament\Resources\JenisIurans\Pages;

use App\Filament\Resources\JenisIurans\JenisIuranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJenisIuran extends EditRecord
{
    protected static string $resource = JenisIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
