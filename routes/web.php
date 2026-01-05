<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


use Illuminate\Support\Facades\Route;
use App\Models\Iuran;
use App\Models\Pengeluaran;
use App\Models\PosAnggaran;

Route::get('/', function () {
    // --- 1. LOGIKA GLOBAL ---
    $totalPemasukan = Iuran::where('status', 'lunas')->sum('nominal');
    $totalPengeluaran = Pengeluaran::sum('nominal'); // Pastikan model Pengeluaran ada
    $saldoBersih = $totalPemasukan - $totalPengeluaran;

    // --- 2. LOGIKA POS ANGGARAN ---
    $posAnggarans = PosAnggaran::withSum('mutasiDanas', 'nominal')
        ->get();

    return view('welcome', [
        'totalPemasukan' => $totalPemasukan,
        'totalPengeluaran' => $totalPengeluaran,
        'saldoBersih' => $saldoBersih,
        'posAnggarans' => $posAnggarans
    ]);
});

Route::get('/pengeluaran', function () {
    // Ambil data pengeluaran, urutkan dari yang terbaru
    // paginate(15) artinya tampilkan 15 baris per halaman
    $pengeluarans = Pengeluaran::latest('tanggal')->paginate(15);

    return view('pengeluaran', [
        'pengeluarans' => $pengeluarans
    ]);
});
