<?php

namespace App\Filament\Resources\MonitoringIurans\Tables;

use Carbon\Carbon;
use App\Models\Warga;
use App\Models\JenisIuran;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection; // <--- Import ini
use Filament\Actions\Action;

class MonitoringIuransTable
{
    public static function configure(Table $table): Table
    {
        $columns = [];

        // 1. Kolom Nama, Blok, No, Telepon
        $columns[] = TextColumn::make('nama')->label('Nama Warga')->searchable()->sortable()->weight('bold');
        $columns[] = TextColumn::make('blok_rumah')->label('Blok')->searchable()->sortable()->weight('bold');
        $columns[] = TextColumn::make('no_rumah')->label('No')->searchable()->sortable()->weight('bold');
        $columns[] = TextColumn::make('telepon')->label('Telepon')->searchable()->sortable()->weight('bold');

        // 2. Loop Kolom Bulan 1-12
        foreach (range(1, 12) as $bulan) {
            $namaBulan = Carbon::create()->month($bulan)->translatedFormat('M');

            $columns[] = IconColumn::make('bulan_' . $bulan)
                ->label($namaBulan)
                ->alignment('center')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('gray')
                ->boolean()
                ->state(function (Warga $record, $livewire) use ($bulan) {
                    $filterData = $livewire->tableFilters;
                    $tahun = $filterData['tahun']['value'] ?? now()->year;
                    $jenisIuranId = $filterData['jenis_iuran']['value'] ?? null;

                    if (!$jenisIuranId) return false;

                    // Cek status lunas di collection yang sudah di-load
                    return (bool) $record->iurans->first(function ($item) use ($bulan, $tahun, $jenisIuranId) {
                        return $item->bulan == $bulan
                            && $item->tahun == $tahun
                            && $item->jenis_iuran_id == $jenisIuranId
                            && $item->status == 'lunas';
                    });
                });
        }

        return $table
            // 3. Query Utama (Ditambah Order By agar rapi saat dicetak)
            ->query(
                Warga::query()
                    ->with('iurans')
                    ->orderBy('blok_rumah', 'asc')
                    ->orderBy('no_rumah', 'asc')
            )
            ->columns($columns)

            // 4. Filter Tahun & Jenis Iuran
            ->filters([
                SelectFilter::make('tahun')
                    ->options(function () {
                        $now = now()->year;
                        $years = range($now - 2, $now + 2);
                        return array_combine($years, $years);
                    })
                    ->default(now()->year)
                    ->selectablePlaceholder(false)
                    // PENTING: Override query agar tidak filter tabel wargas
                    ->query(fn(Builder $query) => $query),

                SelectFilter::make('jenis_iuran')
                    ->options(JenisIuran::where('is_active', true)->pluck('nama', 'id'))
                    ->default(fn() => JenisIuran::where('is_active', true)->first()?->id)
                    ->selectablePlaceholder(false)
                    // PENTING: Override query agar tidak filter tabel wargas
                    ->query(fn(Builder $query) => $query),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->headerActions([
                Action::make('download_pdf_all')
                    ->label('Download PDF')
                    ->icon('heroicon-o-printer')
                    ->color('primary')
                    ->action(function ($livewire) {
                        // 1. Ambil Nilai Filter
                        $filterData = $livewire->tableFilters;
                        $tahun = $filterData['tahun']['value'] ?? now()->year;

                        $defaultJenis = JenisIuran::where('is_active', true)->first();
                        $jenisIuranId = $filterData['jenis_iuran']['value'] ?? $defaultJenis?->id;

                        $namaJenis = $defaultJenis?->nama;
                        if ($filterData['jenis_iuran']['value']) {
                            $namaJenis = JenisIuran::find($jenisIuranId)?->nama;
                        }

                        // 2. Ambil SEMUA Warga (Sesuai urutan tabel)
                        // Kita load relasi iuran khusus tahun/jenis yang dipilih
                        $wargas = Warga::query()
                            ->with(['iurans' => function ($q) use ($tahun, $jenisIuranId) {
                                $q->where('tahun', $tahun)
                                    ->where('jenis_iuran_id', $jenisIuranId);
                            }])
                            ->orderBy('blok_rumah', 'asc')
                            ->orderBy('no_rumah', 'asc')
                            ->get();

                        // 3. Render PDF
                        $pdf = Pdf::loadView('pdf.monitoring-iuran', [
                            'wargas' => $wargas,
                            'tahun' => $tahun,
                            'nama_iuran' => $namaJenis,
                            'jenis_iuran_id' => $jenisIuranId
                        ])->setPaper('a4', 'landscape');

                        // 4. Download
                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, 'Laporan-Iuran-' . $tahun . '.pdf');
                    }),
            ])
            // 5. Actions (Kosongkan jika hanya monitoring)
            ->actions([])

            // 6. Bulk Actions (Tempat Tombol Download PDF)
            ->bulkActions([
                BulkActionGroup::make([]),
            ]);
    }
}
