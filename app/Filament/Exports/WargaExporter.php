<?php

namespace App\Filament\Exports;

use App\Models\Warga;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;
use Filament\Actions\Exports\Enums\ExportFormat;

class WargaExporter extends Exporter
{
    protected static ?string $model = Warga::class;

    public static function getColumns(): array
    {
        return [
            // ExportColumn::make('id')
            //     ->label('ID'),
            ExportColumn::make('nama'),
            ExportColumn::make('blok_rumah'),
            ExportColumn::make('no_rumah'),
            ExportColumn::make('jenis_kelamin'),
            ExportColumn::make('telepon'),
        ];
    }


    public function getFileName(Export $export): string
    {
        return "data-warga-{$export->getKey()}.xlsx";
    }

    public function getFormats(): array
    {
        return [
            ExportFormat::Xlsx,
        ];
    }
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your warga export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
