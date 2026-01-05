<?php

namespace App\Observers;

use App\Models\Iuran;
use App\Models\MutasiDana;
use Illuminate\Support\Facades\DB;

class IuranObserver
{
    /**
     * Handle the Iuran "created" event.
     */
    public function created(Iuran $iuran): void
    {
        if ($iuran->status === 'lunas') {
            $this->prosesDroppingDana($iuran);
        }
    }

    /**
     * Handle the Iuran "updated" event.
     */
    public function updated(Iuran $iuran): void
    {
        if ($iuran->isDirty('status') && $iuran->status === 'lunas') {
            $this->prosesDroppingDana($iuran);
        }
        if ($iuran->isDirty('status') && $iuran->status === 'belum') {
            MutasiDana::where('iuran_id', $iuran->id)->delete();
        }
    }

    /**
     * Handle the Iuran "deleted" event.
     */
    public function deleted(Iuran $iuran): void
    {
        //
    }

    /**
     * Handle the Iuran "restored" event.
     */
    public function restored(Iuran $iuran): void
    {
        //
    }

    /**
     * Handle the Iuran "force deleted" event.
     */
    public function forceDeleted(Iuran $iuran): void
    {
        //
    }
    protected function prosesDroppingDana(Iuran $iuran)
    {
        // 1. Ambil aturan alokasi dari jenis iurannya
        // $aturan = $iuran->jenis->aturanAlokasis;
        DB::transaction(function () use ($iuran) {

            // 1. Hapus dulu mutasi lama (jika ada) biar tidak duplikat saat edit-edit
            MutasiDana::where('iuran_id', $iuran->id)->delete();

            // 2. Ambil aturan pembagian dari Jenis Iuran
            // Kita load relasinya: Iuran -> JenisIuran -> AturanAlokasis
            $aturanList = $iuran->jenis->aturanAlokasis;

            // 3. Loop setiap aturan
            foreach ($aturanList as $aturan) {
                $nominalMasuk = 0;

                if ($aturan->tipe === 'persen') {
                    // Rumus: (Nominal Bayar x Persen) / 100
                    $nominalMasuk = ($iuran->nominal * $aturan->nilai) / 100;
                } else {
                    // Rumus: Nominal Fix (tapi tidak boleh melebihi bayaran)
                    $nominalMasuk = min($aturan->nilai, $iuran->nominal);
                }

                // 4. Simpan ke tabel Mutasi
                if ($nominalMasuk > 0) {
                    MutasiDana::create([
                        'iuran_id' => $iuran->id,
                        'pos_anggaran_id' => $aturan->pos_anggaran_id,
                        'nominal' => $nominalMasuk,
                    ]);
                }
            }
        });
    }
}
