<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AturanAlokasi extends Model
{
    protected $guarded = [];

    public function posAnggaran()
    {
        return $this->belongsTo(PosAnggaran::class);
    }
}
