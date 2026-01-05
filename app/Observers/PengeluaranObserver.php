<?php

namespace App\Observers;

use App\Models\Pengeluaran;
use App\Models\MutasiDana;

class PengeluaranObserver
{
    /**
     * Saat Pengeluaran Dibuat -> Kurangi Saldo
     */
    public function created(Pengeluaran $pengeluaran): void
    {
        $this->catatMutasi($pengeluaran);
    }

    /**
     * Saat Pengeluaran Diedit -> Update Pengurangan Saldo
     */
    public function updated(Pengeluaran $pengeluaran): void
    {
        // Hapus mutasi lama dulu biar bersih
        MutasiDana::where('pengeluaran_id', $pengeluaran->id)->delete();

        // Buat baru
        $this->catatMutasi($pengeluaran);
    }

    /**
     * Logic Simpan Mutasi Negatif
     */
    protected function catatMutasi(Pengeluaran $pengeluaran)
    {
        // Load jenis pengeluaran untuk tahu ambil duit dari pos mana
        $jenis = $pengeluaran->jenisPengeluaran;

        if ($jenis && $jenis->pos_anggaran_id) {
            MutasiDana::create([
                'pengeluaran_id' => $pengeluaran->id,
                'pos_anggaran_id' => $jenis->pos_anggaran_id,

                // PENTING: Simpan sebagai negatif agar mengurangi saldo
                'nominal' => -abs($pengeluaran->nominal),
            ]);
        }
    }

    // Saat dihapus, mutasi otomatis hilang karena cascadeOnDelete di migration
}
