<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MutasiDana extends Model
{
    protected $guarded = [];

    public function posAnggaran()
    {
        return $this->belongsTo(PosAnggaran::class);
    }

    public function iuran()
    {
        return $this->belongsTo(Iuran::class);
    }
}
