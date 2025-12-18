<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Iuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id',
        'jenis_iuran_id',
        'nominal',
        'bulan',
        'tahun',
        'status',
        'bukti_bayar',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function jenis()
    {
        return $this->belongsTo(JenisIuran::class, 'jenis_iuran_id');
    }
}
