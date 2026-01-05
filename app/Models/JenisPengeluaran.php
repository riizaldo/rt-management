<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPengeluaran extends Model
{
    protected $fillable = [
        'nama',
        'keterangan',
        'is_active',
    ];

    public function posAnggaran()
    {
        return $this->belongsTo(PosAnggaran::class);
    }
}
