<?php

namespace App\Filament\Resources\MonitoringIurans\Pages;

use App\Filament\Resources\MonitoringIurans\MonitoringIuranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMonitoringIurans extends ListRecords
{
    protected static string $resource = MonitoringIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
