<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $guarded = [];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }
}
