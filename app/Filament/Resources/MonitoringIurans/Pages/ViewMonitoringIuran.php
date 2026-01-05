<?php

namespace App\Filament\Resources\MonitoringIurans\Pages;

use App\Filament\Resources\MonitoringIurans\MonitoringIuranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMonitoringIuran extends ViewRecord
{
    protected static string $resource = MonitoringIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
