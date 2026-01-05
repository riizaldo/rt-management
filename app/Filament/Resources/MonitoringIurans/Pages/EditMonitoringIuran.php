<?php

namespace App\Filament\Resources\MonitoringIurans\Pages;

use App\Filament\Resources\MonitoringIurans\MonitoringIuranResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMonitoringIuran extends EditRecord
{
    protected static string $resource = MonitoringIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
