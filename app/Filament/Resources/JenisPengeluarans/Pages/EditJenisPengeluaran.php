<?php

namespace App\Filament\Resources\JenisPengeluarans\Pages;

use App\Filament\Resources\JenisPengeluarans\JenisPengeluaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJenisPengeluaran extends EditRecord
{
    protected static string $resource = JenisPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
