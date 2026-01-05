<?php

namespace App\Filament\Widgets;

use App\Models\Iuran;
use App\Models\Pengeluaran;
use App\Models\PosAnggaran;
use Illuminate\Support\Number;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // --- BAGIAN 1: HITUNGAN GLOBAL (YANG SUDAH ADA) ---

        // 1. Hitung Pemasukan (Iuran yang statusnya 'lunas')
        $totalPemasukan = Iuran::where('status', 'lunas')->sum('nominal');

        // 2. Hitung Pengeluaran
        $totalPengeluaran = Pengeluaran::sum('nominal');

        // 3. Saldo Bersih
        $saldoBersih = $totalPemasukan - $totalPengeluaran;

        // Helper format rupiah
        $formatRupiah = fn($amount) => Number::currency($amount, 'IDR', 'id');

        $saldoColor = $saldoBersih >= 0 ? 'success' : 'danger';
        $saldoIcon = $saldoBersih >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';

        // Masukkan data global ke array utama
        $stats = [
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

        // --- BAGIAN 2: SISIPAN POS ANGGARAN (DATA DARI DROPPING) ---

        // Ambil Pos Anggaran beserta total dropping-nya
        $posAnggarans = PosAnggaran::withSum('mutasiDanas', 'nominal')
            ->get();

        foreach ($posAnggarans as $pos) {
            // Ambil total, jika null jadikan 0
            $totalPos = $pos->mutasi_danas_sum_nominal ?? 0;

            // Tambahkan ke array $stats
            $stats[] = Stat::make($pos->nama, $formatRupiah($totalPos))
                ->description('Kode: ' . $pos->kode)
                ->descriptionIcon('heroicon-m-banknotes') // Ikon pembeda untuk pos
                ->color('info') // Warna biru biar beda dengan saldo utama
                ->chart([3, 5, 8, 3, 9]); // Hiasan grafik
        }

        return $stats;
    }
}
