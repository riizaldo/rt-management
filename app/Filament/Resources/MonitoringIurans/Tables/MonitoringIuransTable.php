<?php

namespace App\Filament\Resources\MonitoringIurans\Tables;

use Carbon\Carbon;
use App\Models\Warga;
use App\Models\JenisIuran;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class MonitoringIuransTable
{
    public static function configure(Table $table): Table
    {
        // --- 1. SIAPKAN ARRAY KOLOM DULU ---
        $columns = [];

        // Kolom Nama (Sticky)
        $columns[] = TextColumn::make('nama')
            ->label('Nama Warga')
            ->searchable()
            ->sortable()
            ->weight('bold');

        $columns[] = TextColumn::make('telepon')
            ->label('Telepon')
            ->searchable()
            ->sortable()
            ->weight('bold');

        // Loop Bulan 1-12
        foreach (range(1, 12) as $bulan) {
            $namaBulan = Carbon::create()->month($bulan)->translatedFormat('M'); // Jan, Feb...

            $columns[] = IconColumn::make('bulan_' . $bulan)
                ->label($namaBulan)
                ->alignment('center')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('gray')
                ->boolean()
                // Logic pengecekan lunas/belum
                ->state(function (Warga $record, $livewire) use ($bulan) {
                    $filterData = $livewire->tableFilters;

                    $tahun = $filterData['tahun']['value'] ?? now()->year;
                    $jenisIuranId = $filterData['jenis_iuran']['value'] ?? null;

                    if (!$jenisIuranId) return false;

                    // Cek data di collection yang sudah di-load
                    $iuran = $record->iurans->first(function ($item) use ($bulan, $tahun, $jenisIuranId) {
                        return $item->bulan == $bulan
                            && $item->tahun == $tahun
                            && $item->jenis_iuran_id == $jenisIuranId
                            && $item->status == 'lunas';
                    });

                    return (bool) $iuran;
                });
        }

        // --- 2. RETURN TABLE DENGAN KOLOM YANG SUDAH DISIAPKAN ---
        return $table
            // Penting: Load relasi biar kencang
            ->query(Warga::query()->with('iurans'))
            ->columns($columns)

            ->filters([
                SelectFilter::make('tahun')
                    ->options(function () {
                        $now = now()->year;
                        $years = range($now - 2, $now + 2);
                        return array_combine($years, $years);
                    })
                    ->default(now()->year)
                    ->selectablePlaceholder(false)->query(fn(Builder $query) => $query),

                // Filter Jenis Iuran
                SelectFilter::make('jenis_iuran')
                    ->options(JenisIuran::where('is_active', true)->pluck('nama', 'id'))
                    ->default(fn() => JenisIuran::where('is_active', true)->first()?->id)
                    ->selectablePlaceholder(false)->query(fn(Builder $query) => $query),
            ])
            ->filtersLayout(FiltersLayout::AboveContent) // Agar filter muncul di atas tabel

            // --- INI BAGIAN BAWAAN ANDA ---
            ->actions([ // Saya ganti recordActions jadi actions (standar Table)
                // ViewAction::make(),
                // EditAction::make(), // Matikan edit jika ini cuma monitoring
            ])
            ->bulkActions([ // Saya ganti toolbarActions jadi bulkActions (standar Table)
                BulkActionGroup::make([
                    // DeleteBulkAction::make(), // Matikan delete jika ini cuma monitoring
                ]),
            ]);
    }
}
