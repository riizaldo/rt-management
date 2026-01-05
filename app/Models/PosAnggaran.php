<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosAnggaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    // --- TAMBAHKAN INI ---

    // Relasi 1 Pos Anggaran bisa punya banyak history Mutasi Dana
    public function mutasiDanas()
    {
        return $this->hasMany(MutasiDana::class);
    }

    // (Opsional) Relasi untuk melihat Pos ini terdaftar di Aturan Alokasi mana saja
    public function aturanAlokasis()
    {
        return $this->hasMany(AturanAlokasi::class);
    }
}
