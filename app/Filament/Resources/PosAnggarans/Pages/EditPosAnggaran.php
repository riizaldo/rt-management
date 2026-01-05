<?php

namespace App\Filament\Resources\PosAnggarans\Pages;

use App\Filament\Resources\PosAnggarans\PosAnggaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPosAnggaran extends EditRecord
{
    protected static string $resource = PosAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
