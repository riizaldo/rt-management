<?php

namespace App\Filament\Widgets;

use App\Models\Iuran;
use App\Models\Pengeluaran;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Support\Number;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // 1. Hitung Pemasukan (Iuran yang statusnya 'lunas')
        $totalPemasukan = Iuran::where('status', 'lunas')->sum('nominal');

        // 2. Hitung Pengeluaran
        $totalPengeluaran = Pengeluaran::sum('nominal');

        // 3. Saldo Bersih
        $saldoBersih = $totalPemasukan - $totalPengeluaran;

        $formatRupiah = fn($amount) => Number::currency($amount, 'IDR', 'id');
        $saldoColor = $saldoBersih >= 0 ? 'success' : 'danger';
        $saldoIcon = $saldoBersih >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';

        return [
            Stat::make('💰 Total Pemasukan Iuran', $formatRupiah($totalPemasukan))
                ->description('Dari Iuran yang sudah lunas')
                ->color('success'),

            Stat::make('💸 Total Pengeluaran', $formatRupiah($totalPengeluaran))
                ->description('Total dana yang dikeluarkan')
                ->color('danger'),

            Stat::make('📊 Saldo Kas Bersih', $formatRupiah($saldoBersih))
                ->description('Selisih Pemasukan dan Pengeluaran')
                ->descriptionIcon($saldoIcon)
                ->color($saldoColor),
        ];
    }
}
