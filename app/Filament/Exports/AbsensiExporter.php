<?php

namespace App\Filament\Exports;

use App\Models\Absensi;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class AbsensiExporter extends Exporter
{
    protected static ?string $model = Absensi::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('acara.nama')->label('Acara'),
            ExportColumn::make('acara.tanggal')->label('Tanggal'),
            ExportColumn::make('warga.nama')->label('Nama Warga'),
            ExportColumn::make('status'), // hadir/izin/sakit/alpa
            ExportColumn::make('keterangan'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your absensi export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
